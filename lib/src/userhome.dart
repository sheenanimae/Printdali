import 'dart:convert';
import 'dart:io';
import 'package:flushbar/flushbar.dart';
import 'package:flutter_rating_bar/flutter_rating_bar.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:hexcolor/hexcolor.dart';
import 'package:http/http.dart' as http;
// import 'package:intl/intl.dart';
import 'dart:async';
import 'package:flutter/material.dart';
import 'package:printdali/src/loginSrc.dart';
import 'package:image_picker/image_picker.dart';
import 'API.dart';
import 'history.dart';
import 'homeSrc.dart';
import 'loadingSrc.dart';

class userhome extends StatefulWidget {
  userhomeState createState() => userhomeState(userid, service_id, user_email);
  String userid;
  String service_id;
  String user_email;
  userhome({this.userid, this.service_id, this.user_email});
}

// ignore: camel_case_types
class userhomeState extends State<userhome> {
  String value;
  String userid;

  String service_id;
  String user_email;
  userhomeState(this.userid, this.service_id, this.user_email);
  String notif = "0";
  String ongoing = "0";
  bool loading = true;
  List data = [];
  List data2 = [];
  String email;
  String fullname;
  Widget finad;
  Future<List> getData() async {
    var urls = Uri.parse(local_IP_Port +
        "Mobilelogin/getuserTransaction");
    final response = await http.post(urls, body: {"user_id": userid});
    data2 = json.decode(response.body);
      // loading =false;
    return data2;
  }

  Future<List> getuserinfo() async {
    var urls = Uri.parse(local_IP_Port + "Mobilelogin/getuserInfo");
    final response = await http.post(urls, body: {"user_id": userid});
    data = json.decode(response.body);
    this.setState(() {
      email = data[0]['user_email'];
      fullname = data[0]['user_fname'] + " " + data[0]['user_lname'];

      loading = false;
    });
    // print(data[0]['user_id']);
    // return data;
  }

  @override
  initState() {
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
        title: Text("Dashboard"),
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
                child: Text(
                  '${fullname[0]}',
                  style: TextStyle(fontSize: 40.0),
                ),
              ),
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
                        pageBuilder: (a, b, c) => userhome(userid: userid)));
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
                            service_id: service_id,
                            user_email: user_email,
                          )
                        : new Center(
                            child: loadingSrc(),
                          );
                  })),
    );
  }
}

class ItemList extends StatefulWidget {
  _ItemListState createState() =>
      _ItemListState(userid, list, service_id, user_email);
  final List list;
  String service_id;
  String user_email;
  String userid;
  ItemList({this.userid, this.list, this.service_id, this.user_email});
}

class _ItemListState extends State<ItemList> {
  final List list;
  double _rating;

  double _initialRating = 2.0;
  bool _isRTLMode = false;
  bool _isVertical = false;
  String service_id;
  String user_email;
  String userid;
  _ItemListState(this.userid, this.list, this.service_id, this.user_email);
  @override
  initState() {
    _rating = _initialRating;
    super.initState();
  }

  String VendorEmail = "";
  double enerating;
  String servid = "";
  List<Widget> fileListThumb;
  // ignore: deprecated_member_use
  List<File> fileList = new List<File>();
  Future<File> file;

  String errMessage = 'Error Uploading Image';
  String status = '';
  File tmpFile;
  String base64Image;
  String costumer_id;
  String user_contactnumber;
  void _showPicker(context) {
    showModalBottomSheet(
        context: context,
        builder: (BuildContext) {
          return SafeArea(
            child: Container(
              child: new Wrap(
                children: <Widget>[
                  new ListTile(
                      leading: new Icon(Icons.photo_library),
                      title: new Text('Photo Library'),
                      onTap: () {
                        chooseImage();
                        Navigator.of(context).pop();
                      }),
                ],
              ),
            ),
          );
        });
  }

  chooseImage() {
    setState(() {
      file = ImagePicker.pickImage(source: ImageSource.gallery);
    });
    setStatus('');
  }

  setStatus(String message) {
    setState(() {
      status = message;
    });
  }

  Future<bool> upload(Map params) async {
    String endpoint =local_IP_Port + "Mobilelogin/uploadpaymentSS";
    // ignore: missing_return
    return await http.post(endpoint, body: params).then((response) {
      print(response.body);
      if (response.body == 'OK') {
        return true;
      } else
        return false;
    });
  }

  Widget showImage() {
    return FutureBuilder<File>(
      future: file,
      builder: (BuildContext context, AsyncSnapshot<File> snapshot) {
        if (snapshot.connectionState == ConnectionState.done &&
            null != snapshot.data) {
          tmpFile = snapshot.data;
          base64Image = base64Encode(snapshot.data.readAsBytesSync());
          Timer(
            Duration(milliseconds: 50),
            () {
              setState(() {
                tmpFile = snapshot.data;
                base64Image = base64Encode(snapshot.data.readAsBytesSync());
              });
            },
          );

          return Center(
            child: Row(children: <Widget>[
              Container(
                height: 150,
                width: 150,
                child: Image.file(
                  snapshot.data,
                  height: 140,
                  width: 140,
                  fit: BoxFit.scaleDown,
                ),
              )
            ]),
          );
        } else if (null != snapshot.error) {
          return const Text(
            'Error Picking Image',
            textAlign: TextAlign.center,
          );
        } else {
          return Flexible(
              child: Row(children: <Widget>[
            Expanded(
              child: Text(
                'No Image Selected',
                textAlign: TextAlign.center,
              ),
            )
          ]));
        }
      },
    );
  }

  Future<void> _showMyDialog() async {
    final Map params = new Map();
    return showDialog<void>(
      context: this.context,
      barrierDismissible: true, // user must tap button!
      builder: (BuildContext context) {
        return AlertDialog(
          title: Text('G-cash: ' + user_contactnumber),
          content: Container(
            height: 300,
            child: SingleChildScrollView(
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: <Widget>[
                  Container(
                      height: 160,
                      width: 160,
                      child: Center(
                        child: Row(children: <Widget>[
                          showImage(),
                        ]),
                      )),
                  Container(
                    child: Column(
                      children: [
                        new Row(children: <Widget>[
                          Expanded(
                              child: Padding(
                            padding: const EdgeInsets.only(
                                left: 0.0, right: 0.0, top: 2.0),
                            child: Container(
                              // ignore: deprecated_member_use
                              child: RaisedButton.icon(
                                onPressed: () {
                                  _showPicker(
                                      context); // call choose image function
                                },
                                icon: Icon(Icons.folder_open),
                                label: Text("CHOOSE IMAGE"),
                                color: Colors.deepOrangeAccent,
                                colorBrightness: Brightness.dark,
                              ),
                            ),
                          ))
                        ]),
                        new Row(children: <Widget>[
                          Expanded(
                              child: Padding(
                            padding: const EdgeInsets.only(
                                left: 0.0, right: 0.0, top: 2.0),
                            child: Container(
                                //show upload button after choosing image
                                //if uploadimage is null then show empty container

                                //elese show uplaod button
                                child: RaisedButton.icon(
                              onPressed: () {
                                Navigator.of(context, rootNavigator: true)
                                    .pop('dialog');
                                _showMyDialog();
                              },
                              //start uploading image
                              //
                              icon: Icon(Icons.image),
                              label: Text("View Image"),
                              color: Colors.deepOrangeAccent,
                              colorBrightness: Brightness.dark,
                              //set brghtness to dark, because deepOrangeAccent is darker coler
                              //so that its text color is light
                            )),
                          ))
                        ]),
                        new Row(children: <Widget>[
                          Expanded(
                              child: Padding(
                            padding: const EdgeInsets.only(
                                left: 0.0, right: 0.0, top: 2.0),
                            child: Container(
                                // ignore: deprecated_member_use
                                child: RaisedButton.icon(
                              onPressed: () async {
                                params["imagepayment"] =
                                    jsonEncode(base64Image);
                                params["user_id"] = jsonEncode(servid);
                                // params["service_id"] = jsonEncode(service_id);
                                params["costumer_id"] = jsonEncode(costumer_id);
                                params["user_email"] = jsonEncode(VendorEmail);
                                String fileName = tmpFile.path.split('/').last;
                                params["fileName"] = jsonEncode(fileName);
                                upload(params).then((sukses) {
                                  if (sukses == true) {
                                    Navigator.push(
                                      context,
                                      MaterialPageRoute(
                                        builder: (context) =>
                                            userhome(userid: userid),
                                      ),
                                    );
                                  } else
                                    Flushbar(
                                      message: "fail :(",
                                      icon: Icon(
                                        Icons.error_outline,
                                        size: 28.0,
                                        color: Colors.blue[300],
                                      ),
                                      duration: Duration(seconds: 3),
                                      leftBarIndicatorColor: Colors.red[300],
                                    ).show(context);
                                });
                              },
                              //start uploading image
                              //
                              icon: Icon(Icons.file_upload),
                              label: Text("UPLOAD RECIEPT"),
                              color: Colors.deepOrangeAccent,
                              colorBrightness: Brightness.dark,
                              //set brghtness to dark, because deepOrangeAccent is darker coler
                              //so that its text color is light
                            )),
                          ))
                        ]),
                      ],
                    ),
                  )
                ],
              ),
            ),
          ),
        );
      },
    );
  }

  Future<void> Rateus() async {
    final Map params = new Map();
    return showDialog<void>(
      context: this.context,
      barrierDismissible: true, // user must tap button!
      builder: (BuildContext context) {
        return AlertDialog(
          content: Directionality(
            textDirection: _isRTLMode ? TextDirection.rtl : TextDirection.ltr,
            child: SingleChildScrollView(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                mainAxisSize: MainAxisSize.min,
                children: <Widget>[
                  SizedBox(
                    height: 40.0,
                  ),
                  _heading('Rating Bar'),
                  _ratingBar(),
                  SizedBox(height: 20.0),
                  FractionallySizedBox(
                    widthFactor:
                        0.5, // means 100%, you can change this to 0.8 (80%)
                    // ignore: deprecated_member_use
                    child: RaisedButton.icon(
                      onPressed: () {
                        setState(() {
                          enerating = (_rating * 20) as double;
                        });
                        rateus();
                      },
                      label:
                          Text('Submit', style: TextStyle(color: Colors.red)),
                      icon: Icon(Icons.rate_review, color: Colors.red),
                    ),
                  )
                ],
              ),
            ),
          ),
        );
      },
    );
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
                        height: 250,
                        padding: const EdgeInsets.all(8.0),
                        child: Image.network(local_IP_Port +
                                "assets/VendorApplicationData/" +
                                '${list[i]['user_email']}' +
                                "/Store_Img.png",
                            fit: BoxFit.cover,
                            scale: 1.0)),
                  ),
                  Center(
                      child: Container(
                    padding: const EdgeInsets.all(10.0),
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text("Store Name: ${list[i]['store_name']}",
                            style: TextStyle(
                                fontWeight: FontWeight.w300,
                                fontSize: 18.0,
                                color: Color(0xFF162A49))),
                        Text("Status: ${list[i]['status']}"),
                        Text("Copy: ${list[i]['numbercopy']}"),
                        Text("Type: ${list[i]['colortype']}"),
                        Text("Note: ${list[i]['transactionNote']}"),
                        Text("Pickup Time : ${list[i]['pickupDateandTime']}"),
                        list[i]['paymentSS'] == "" ||
                                list[i]['paymentSS'] == null
                            ? Text("Total price : ${list[i]['total_price']}")
                            : Text(
                                "Total price : ${list[i]['total_price']} Payment Screenshot received"),
                        Text("Payment method : ${list[i]['payment_method']}"),
                        list[i]['total_price'] == '0'
                            ? list[i]['status'] != 'success'
                                ? FractionallySizedBox(
                                    widthFactor:
                                        1, // means 100%, you can change this to 0.8 (80%)
                                    // ignore: deprecated_member_use
                                    child: RaisedButton.icon(
                                      onPressed: null,
                                      label: Text('Pay Now',
                                          style: TextStyle(color: Colors.grey)),
                                      icon:
                                          Icon(Icons.check, color: Colors.grey),
                                    ),
                                  )
                                : Text('data')
                            : list[i]['status'] != 'success'
                                ? FractionallySizedBox(
                                    widthFactor:
                                        1, // means 100%, you can change this to 0.8 (80%)
                                    // ignore: deprecated_member_use
                                    child: RaisedButton.icon(
                                      onPressed: () {
                                        setState(() {
                                          VendorEmail = list[i]['user_email'];
                                          servid = list[i]['service_id'];
                                          costumer_id = list[i]['costumer_id'];
                                          user_contactnumber =
                                              list[i]['user_contactnumber'];
                                        });
                                        _showMyDialog();
                                      },
                                      label: Text('Pay Now',
                                          style: TextStyle(
                                              color: HexColor("#ffbd59"))),
                                      icon: Icon(Icons.check,
                                          color: HexColor("#ffbd59")),
                                    ),
                                  )
                                : Text(''),
                        list[i]['status'] == 'success'
                            ? FractionallySizedBox(
                                widthFactor:
                                    1, // means 100%, you can change this to 0.8 (80%)
                                // ignore: deprecated_member_use
                                child: RaisedButton.icon(
                                  onPressed: () {
                                    // // rateus();
                                    Rateus();
                                    setState(() {
                                      VendorEmail = list[i]['user_email'];
                                      servid = list[i]['service_id'];
                                      costumer_id = list[i]['costumer_id'];
                                    });
                                  },
                                  label: Text('Rate us',
                                      style: TextStyle(color: Colors.red)),
                                  icon: Icon(Icons.star, color: Colors.red),
                                ),
                              )
                            : list[i]['costumer_status'] == '0'?FractionallySizedBox(
                                widthFactor:
                                    1, // means 100%, you can change this to 0.8 (80%)
                                // ignore: deprecated_member_use
                                child: RaisedButton.icon(
                                  onPressed: () {
                                    setState(() {
                                      VendorEmail = list[i]['user_email'];
                                      servid = list[i]['service_id'];
                                      costumer_id = list[i]['costumer_id'];
                                    });
                                    cancelTrasaction();
                                  },
                                  label: Text('Cancel',
                                      style: TextStyle(color: Colors.red)),
                                  icon: Icon(Icons.exit_to_app,
                                      color: Colors.red),
                                ),
                              ):Text(""),
                        list[i]['status'] == 'success'
                            ? FractionallySizedBox(
                                widthFactor:
                                    1, // means 100%, you can change this to 0.8 (80%)
                                // ignore: deprecated_member_use
                                child: RaisedButton.icon(
                                  onPressed: () {
                                    skiprate();
                                    setState(() {
                                      VendorEmail = list[i]['user_email'];
                                      servid = list[i]['service_id'];
                                      costumer_id = list[i]['costumer_id'];
                                    });
                                  },
                                  label: Text('Skip',
                                      style: TextStyle(color: Colors.red)),
                                  icon: Icon(Icons.exit_to_app,
                                      color: Colors.red),
                                ),
                              )
                            : Text('')
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

  void skiprate() async {
    var url = Uri.parse(local_IP_Port + "Mobilelogin/skiprate");

    var result = await http.post(url, body: {
      "costumer_id": costumer_id,
    });
    var myInt = result.body;
    if (myInt == "500") {
      Flushbar(
        message: "error",
        icon: Icon(
          Icons.error,
          size: 28.0,
          color: Colors.blue[300],
        ),
        duration: Duration(seconds: 3),
        leftBarIndicatorColor: Colors.blue[300],
      ).show(context);
    } else {
      Navigator.push(
          context,
          MaterialPageRoute(
            builder: (context) => userhome(userid: userid),
          ));
    }
  }

  void rateus() async {
    var url =
        Uri.parse(local_IP_Port + "Mobilelogin/rateUs");

    var result = await http.post(url,
        body: {"costumer_id": costumer_id, "rate": enerating.toString()});

    var myInt = result.body;
    if (myInt == "500") {
      Flushbar(
        message: "error",
        icon: Icon(
          Icons.error,
          size: 28.0,
          color: Colors.blue[300],
        ),
        duration: Duration(seconds: 3),
        leftBarIndicatorColor: Colors.blue[300],
      ).show(context);
    } else {
      Navigator.push(
          context,
          MaterialPageRoute(
            builder: (context) => userhome(userid: userid),
          ));
    }
  }

  void cancelTrasaction() async {
    var url = Uri.parse(local_IP_Port + "Mobilelogin/cancelTrasaction");

    var result = await http.post(url, body: {
      "costumer_id": costumer_id,
    });

    var myInt = result.body;
    if (myInt == "500") {
      Flushbar(
        message: "Error :(",
        icon: Icon(
          Icons.exit_to_app,
          size: 28.0,
          color: Colors.blue[300],
        ),
        duration: Duration(seconds: 3),
        leftBarIndicatorColor: Colors.blue[300],
      ).show(context);
    } else {
      Flushbar(
        message: "Cancel Successfully",
        icon: Icon(
          Icons.check,
          size: 28.0,
          color: Colors.blue[300],
        ),
        duration: Duration(seconds: 3),
        leftBarIndicatorColor: Colors.blue[300],
      ).show(context);
      Navigator.push(
        context,
        MaterialPageRoute(
          builder: (context) => userhome(userid: userid),
        ),
      );
    }
  }

  Widget _ratingBar() {
    return RatingBar.builder(
      initialRating: _initialRating,
      direction: _isVertical ? Axis.vertical : Axis.horizontal,
      itemCount: 5,
      itemPadding: EdgeInsets.symmetric(horizontal: 2.0),
      itemBuilder: (context, index) {
        switch (index) {
          case 0:
            return Icon(
              Icons.sentiment_very_dissatisfied,
              color: Colors.red,
            );
          case 1:
            return Icon(
              Icons.sentiment_dissatisfied,
              color: Colors.redAccent,
            );
          case 2:
            return Icon(
              Icons.sentiment_neutral,
              color: Colors.amber,
            );
          case 3:
            return Icon(
              Icons.sentiment_satisfied,
              color: Colors.lightGreen,
            );
          case 4:
            return Icon(
              Icons.sentiment_very_satisfied,
              color: Colors.green,
            );
          default:
            return Container();
        }
      },
      onRatingUpdate: (rating) {
        setState(() {
          _rating = rating;
        });
      },
      updateOnDrag: true,
    );
  }

  Widget _heading(String text) => Column(
        children: [
          Text(
            text,
            style: TextStyle(
              fontWeight: FontWeight.w300,
              fontSize: 24.0,
            ),
          ),
          SizedBox(
            height: 20.0,
          ),
        ],
      );
}
