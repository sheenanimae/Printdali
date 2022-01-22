import 'dart:convert';
import 'dart:io';
import 'package:file_picker/file_picker.dart';
import 'package:flushbar/flushbar.dart';
import 'package:flutter_spinkit/flutter_spinkit.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:hexcolor/hexcolor.dart';
import 'package:http/http.dart' as http;
import 'package:icon_badge/icon_badge.dart';
import 'package:intl/intl.dart';
import 'dart:async';
import 'package:flutter/material.dart';
import 'package:printdali/src/loginSrc.dart';
import 'package:image_picker/image_picker.dart';
import 'package:printdali/src/userhome.dart';
import 'API.dart';
import 'homeSrc.dart';
import 'loadingSrc.dart';

class Historyd extends StatefulWidget {
  HistorydState createState() => HistorydState(userid);
  String userid;
  Historyd({
    this.userid,
  });
}

// ignore: camel_case_types
class HistorydState extends State<Historyd> {
  String userid;

  HistorydState(this.userid);
  String notif = "0";
  String ongoing = "0";
  bool loading = true;
  List data = [];
  List data2 = [];
  String email;
  String fullname;
  Widget finad;
  Future<List> getData() async {
    var urls = Uri.parse(local_IP_Port +"Mobilelogin/getdonetransaction");
    final response = await http.post(urls, body: {"user_id": userid});
    data2 = json.decode(response.body);
    
    return data2;
  }

  Future<List> getuserinfo() async {
    var urls = Uri.parse(local_IP_Port + "Mobilelogin/getuserInfo");
    final response = await http.post(urls, body: {"user_id": userid});
    data = json.decode(response.body);
    this.setState(() {
      email = data[0]['user_email'];
      fullname = data[0]['user_fname'] + " " + data[0]['user_lname'];
      loading=false;
    });
    // print(data[0]['user_id']);
    // return data;
  }

  @override
  initState() {
    print(userid);
    Timer(Duration(seconds: 2), () {
      setState(() {
        // loading = false;
      });
    });
    getuserinfo();
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return loading?loadingSrc():Scaffold(
      appBar: AppBar(
        title: Text("History"),
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
              accountEmail: Text(email),
              currentAccountPicture: CircleAvatar(
                backgroundColor:
                    Theme.of(context).platform == TargetPlatform.iOS
                        ? HexColor("#ffbd59")
                        : HexColor("#ffbd59"),
                child:'${fullname[0]}'==null? Text(
                  'loading',
                  style: TextStyle(fontSize: 40.0),
                ): Text(
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
              onTap: () {},
            ),
            ListTile(
              leading: FaIcon(FontAwesomeIcons.map),
              title: Text('Map'),
              onTap: () {
                Navigator.push(
                    context,
                    MaterialPageRoute(
                        builder: (context) => homeSrc(userid: userid)));
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
      body: loading
          ? loadingSrc()
          : RefreshIndicator(
              // ignore: missing_return
              onRefresh: () {
                Navigator.pushReplacement(
                    context,
                    PageRouteBuilder(
                        pageBuilder: (a, b, c) => Historyd(userid: userid)));
              },
              child: FutureBuilder<List>(
                  future: getData(),
                  builder:
                      (BuildContext context, AsyncSnapshot<List> snapshot) {
                    if (snapshot.hasError) print(snapshot.error);

                    return snapshot.hasData
                        ? new ItemList(
                            list: snapshot.data,
                            userid: userid,
                          )
                        : new Center(
                            child: loadingSrc(),
                          );
                  })),
    );
  }
}

class ItemList extends StatefulWidget {
  _ItemListState createState() => _ItemListState(userid, list);
  final List list;
  String userid;
  ItemList({this.userid, this.list});
}

class _ItemListState extends State<ItemList> {
  final List list;
  String userid;
  _ItemListState(this.userid, this.list);
  @override
  initState() {
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return new ListView.builder(
      itemCount: list == null ? 0 : list.length,
      itemBuilder: (context, i) {
        return new Container(
          child: new Card(
              color: Colors.grey[500],
              child: Column(
                children: [
                  Center(
                      child: Container(
                    padding: const EdgeInsets.all(10.0),
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Center(
                          child: Container(
                              height: 250,
                              padding: const EdgeInsets.all(8.0),
                              child: Image.network(local_IP_Port +
                                      "assets/VendorApplicationData/" +
                                      '${list[i]['user_email']}' +
                                      "/Store_Img.png",
                                  fit: BoxFit.cover,
                                  scale: 1.0)),
                        ),
                        Text("Store Name: ${list[i]['store_name']}",
                            style: TextStyle(
                                fontWeight: FontWeight.w300,
                                fontSize: 18.0,
                                color: Color(0xFF162A49))),
                        list[i]['status'] == "11"
                            ? Text("Status: Done")
                            : Text("Status: ${list[i]['status']}"),
                        Text("Total price : ${list[i]['total_price']}"),
                        Text("Payment method : ${list[i]['payment_method']}"),
                      ],
                    ),
                  ))
                ],
                crossAxisAlignment: CrossAxisAlignment.start,
              )),
        );
      },
    );
  }
}
