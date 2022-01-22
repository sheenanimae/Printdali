import 'dart:async';
import 'dart:convert';
import 'dart:ui';

import 'package:flutter/material.dart';
import 'package:flutter_map/flutter_map.dart';
import 'package:flutter_map_marker_cluster/flutter_map_marker_cluster.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:geolocator/geolocator.dart';
import 'package:hexcolor/hexcolor.dart';
import 'package:icon_badge/icon_badge.dart';
import 'package:latlong/latlong.dart';

import 'package:http/http.dart' as http;
import 'package:printdali/src/storeSrc.dart';
import 'package:printdali/src/userhome.dart';

import 'API.dart';
import 'history.dart';
import 'loadingSrc.dart';
import 'loginSrc.dart';

// ignore: camel_case_types
class homeSrc extends StatefulWidget {
  _homeSrcState createState() => _homeSrcState(userid);
  String userid;
  homeSrc({this.userid});
}

// ignore: camel_case_types
class _homeSrcState extends State<homeSrc> {
  final PopupController _popupController = PopupController();
  String userid;
  _homeSrcState(this.userid);
  Position myloc;
  List data = [];
  List data2 = [];
  bool loading = true;
  List<Marker> markers = [];
  LatLng center;
  int intd = 0;
  String storename = "";
  String vendorID = "";
  String email = "";

  String emailU;
  String fullname;
  @override
  void initState() {
    _getCurrentLocation();
    super.initState();
    getuserinfo();
    // getvendorRate();
    //
  }

  Future<List> getuserinfo() async {
    var urls = Uri.parse(local_IP_Port + "Mobilelogin/getuserInfo");
    final response = await http.post(urls, body: {"user_id": userid});
    data2 = json.decode(response.body);
    // print(data2);
    this.setState(() {
      emailU = data2[0]['user_email'];
      fullname = data2[0]['user_fname'] + " " + data2[0]['user_lname'];
    });
    // print(data[0]['user_id']);
    // return data;
  }

  String storeRate;
  final PopupController _popupLayerController = PopupController();
  void getvendorRate() async {
    var url = Uri.parse(local_IP_Port + "Mobilelogin/getstorerate");

    var result = await http.post(url, body: {"vendorID": vendorID});
    print(result.body);
    var myInt = result.body;
    if (myInt == "500") {
      loading = false;
    } else {
      setState(() {
        storeRate = myInt;
        loading = false;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return loading
        ? loadingSrc()
        : Scaffold(
            appBar: AppBar(
              title: Text("Map"),
              centerTitle: true,
              iconTheme: IconThemeData(color: Colors.black),
              backgroundColor: HexColor("#ffbd59"),
            ),
            drawer: Drawer(
              child: ListView(
                // Important: Remove any padding from the ListView.
                padding: EdgeInsets.zero,
                children: <Widget>[
                  UserAccountsDrawerHeader(
                    accountName: Text(fullname),
                    accountEmail: Text(emailU),
                    currentAccountPicture: CircleAvatar(
                      backgroundColor:
                          Theme.of(context).platform == TargetPlatform.iOS
                              ? HexColor("#ffbd59")
                              : HexColor("#ffbd59"),
                      child: Text(
                        '${fullname[0]}',
                        style: TextStyle(fontSize: 40.0),
                      ),
                    ),
                  ),
                  ListTile(
                    leading: FaIcon(FontAwesomeIcons.procedures),
                    title: Text('Ongoing Transaction'),
                    onTap: () {
                      Navigator.push(
                          context,
                          MaterialPageRoute(
                              builder: (context) => userhome(userid: userid)));
                    },
                  ),
                  ListTile(
                    leading: FaIcon(FontAwesomeIcons.history),
                    title: Text('History'),
                    onTap: () {
                      Navigator.push(
                          context,
                          MaterialPageRoute(
                              builder: (context) => Historyd(userid: userid)));
                    },
                  ),
                  ListTile(
                    leading: FaIcon(FontAwesomeIcons.powerOff),
                    title: Text('Logout'),
                    onTap: () {
                      Navigator.push(
                        context,
                        MaterialPageRoute(
                          builder: (context) => loginSrc(),
                        ),
                      );
                    },
                  ),
                ],
              ),
            ),
            body: FlutterMap(
              options: MapOptions(
                center: center,
                zoom: 18,
                interactive: true,
                onTap: (_) => _popupLayerController.hidePopup(),
                plugins: [
                  MarkerClusterPlugin(),
                ],
              ),
              layers: [
                new TileLayerOptions(
                  urlTemplate:
                      "https://api.mapbox.com/styles/v1/blyanaarthur/cknr46s5t0hyd17nmrmpj3bet/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoiYmx5YW5hYXJ0aHVyIiwiYSI6ImNrd25iZXJ4YjJodW4yd252aGNoOXI1cjMifQ.B8C7OizssATOpfm13TdqEA",
                  additionalOptions: {
                    'accessToken':
                        'pk.eyJ1IjoiYmx5YW5hYXJ0aHVyIiwiYSI6ImNrd25iZXJ4YjJodW4yd252aGNoOXI1cjMifQ.B8C7OizssATOpfm13TdqEA',
                    'id': 'mapbox.mapbox-streets-v11',
                  },
                ),
                MarkerLayerOptions(
                  markers: <Marker>[
                    new Marker(
                        anchorPos: AnchorPos.align(AnchorAlign.center),
                        width: 80.0,
                        height: 80.0,
                        point: new LatLng(myloc.latitude, myloc.longitude),
                        builder: (ctx) => GestureDetector(
                            onTap: () => debugPrint("Popup tap!"),
                            child: Container(
                              height: 10,
                              width: 50,
                              child: Text(
                                "Your Location",
                                style: TextStyle(
                                    fontSize: 12,
                                    color: Colors.white,
                                    fontWeight: FontWeight.bold),
                              ),
                            ))),
                    new Marker(
                      anchorPos: AnchorPos.align(AnchorAlign.center),
                      width: 80.0,
                      height: 80.0,
                      point: new LatLng(myloc.latitude, myloc.longitude),
                      builder: (ctx) => Container(
                        child: Icon(Icons.location_pin,
                            color: Colors.blue, size: 30),
                      ),
                    ),
                  ],
                ),
                MarkerClusterLayerOptions(
                  maxClusterRadius: 0,
                  markers: markers,
                  popupOptions: PopupOptions(
                      popupController: _popupController,
                      popupBuilder: (context, marker) {
                        for (int i = 0; i != data.length; i++) {
                          double dataLat;
                          double dataLong;
                          if (data[i]['locationLat'].toString().endsWith("0")) {
                            dataLat = double.parse(data[i]['locationLat']
                                .toString()
                                .substring(
                                    0,
                                    data[i]['locationLat'].toString().length -
                                        1));
                            // print("Lat ends with 0");
                          } else {
                            dataLat = double.parse(data[i]['locationLat']);
                          }

                          if (data[i]['locationLong']
                              .toString()
                              .endsWith("0")) {
                            dataLong = double.parse(data[i]['locationLong']
                                .toString()
                                .substring(
                                    0,
                                    data[i]['locationLong'].toString().length -
                                        1));
                          } else {
                            dataLong = double.parse(data[i]['locationLong']);
                          }

                          if (marker.point.latitude == dataLat &&
                              marker.point.longitude == dataLong) {
                            Timer(
                              Duration(milliseconds: 50),
                              () {
                                getvendorRate();
                                setState(() {
                                  vendorID = data[i]['vendorID'];
                                  email = data[i]['user_email'];
                                  email = data[i]['user_email'];
                                });
                              },
                            );

                            storename = data[i]['store_name'];
                            vendorID = data[i]['vendorID'];
                            email = data[i]['user_email'];
                          }
                        }
                        return Container(
                          width: 120,
                          height: 200,
                          color: Colors.white,
                          child: GestureDetector(
                            onTap: () => debugPrint("Popup tap!"),
                            child: GestureDetector(
                                child: Container(
                                    decoration: new BoxDecoration(
                                        color: HexColor("#ffbd59")),
                                    child: Column(
                                        mainAxisAlignment:
                                            MainAxisAlignment.center,
                                        children: <Widget>[
                                          // Image.asset(
                                          //   'assets/img/logo_white.png',
                                          //   height: 50,
                                          //   width: 50,
                                          // ),

                                          Image.network(
                                              local_IP_Port +
                                                  "assets/VendorApplicationData/" +
                                                  email +
                                                  "/Store_Img.png",
                                              height: 100,
                                              width: 110),
                                          Text(
                                            storename,
                                          ),
                                          Text(
                                            "Rating: " + storeRate + "%",
                                          ),
                                          MaterialButton(
                                            padding: const EdgeInsets.only(
                                                left: 10.0,
                                                right: 10.0,
                                                top: 0,
                                                bottom: 0),
                                            color: HexColor("#4164FB"),
                                            onPressed: () {
                                              Navigator.push(
                                                context,
                                                MaterialPageRoute(
                                                  builder: (context) =>
                                                      storeSrc(
                                                          userid: userid,
                                                          vendorID: vendorID,
                                                          storename: storename),
                                                ),
                                              );
                                            },
                                            child: Text(
                                              'Visit',
                                              style: TextStyle(
                                                  color: Colors.black,
                                                  fontSize: 12,
                                                  fontWeight: FontWeight.bold),
                                            ),
                                          ),
                                          // ),
                                        ]))),
                          ),
                        );
                      }),
                  builder: (context, markers) {
                    return FloatingActionButton(
                      child: Text(markers.length.toString()),
                      onPressed: null,
                    );
                  },
                ),
              ],
            ),
          );
  }

  Future _getCurrentLocation() async {
    // final Geolocator geolocator = Geolocator()..forceAndroidLocationManager;
    var currentLocation = Geolocator();
    currentLocation
        .getCurrentPosition(desiredAccuracy: LocationAccuracy.high)
        .then((Position position) async {
      var urls = Uri.parse(local_IP_Port + "Mobilelogin/getallvendor");
      final response = await http.post(urls, body: {});
      print(response.body);
      data = json.decode(response.body);
      loading = false;
      for (int i = 0; i != data.length; i++) {
        var markerToAdd = Marker(
            anchorPos: AnchorPos.align(AnchorAlign.center),
            height: 40,
            width: 40,
            point: LatLng(double.parse(data[i]["locationLat"]),
                double.parse(data[i]["locationLong"])),
            builder: (ctx) => Icon(
                  Icons.location_pin,
                  color: Colors.red,
                  size: 35,
                ));

        // var nametd = Text("Name of the Store ${data[i]["userid"]}");
        markers.add(markerToAdd);
      }

      setState(() {
        myloc = position;
        center = LatLng(position.latitude, position.longitude);
        loading = false;
        print(data);
      });
    }).catchError((e) {
      // print(e);
    });
  }
}
