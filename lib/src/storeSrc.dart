import 'dart:convert';
import 'package:flutter_spinkit/flutter_spinkit.dart';
import 'package:hexcolor/hexcolor.dart';
import 'package:http/http.dart' as http;
import 'package:printdali/src/loadingSrc.dart';
import 'dart:async';
import 'package:flutter/material.dart';
import 'package:printdali/src/uploadSrc.dart';

import 'API.dart';

class storeSrc extends StatefulWidget {
  _storeSrcState createState() => _storeSrcState(vendorID, storename, userid);
  String storename;
  String userid;
  String vendorID;
  bool loading = false;

  storeSrc({this.vendorID, this.storename, this.userid});
}

// ignore: camel_case_types
class _storeSrcState extends State<storeSrc> {
  String vendorID;
  String storename;
  String userid;
  bool loading = true;
  _storeSrcState(this.vendorID, this.storename, this.userid);
  List data = [];
  Future<List> getData() async {
    var vID = int.parse(vendorID);
    var urls = Uri.parse(local_IP_Port + "Mobilelogin/getVendorServices");
    final response = await http.post(urls, body: {"vendorID": vendorID});
    data = json.decode(response.body);
    return data;
  }

  @override
  initState() {
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(storename + " : Services"),
        leading: IconButton(
          icon: Icon(Icons.arrow_back, color: Colors.black),
          onPressed: () {
            Navigator.pop(context);
          },
        ),
        centerTitle: true,
        backgroundColor: HexColor("#ffbd59"),
      ),
      body: new FutureBuilder<List>(
        future: getData(),
        builder: (context, snapshot) {
          if (snapshot.hasError) print(snapshot.error);
          return snapshot.hasData
              ? new ItemList(
                  userid: userid,
                  list: snapshot.data,
                )
              : loadingSrc();
        },
      ),
    );
  }
}

class ItemList extends StatefulWidget {
  _ItemListState createState() => _ItemListState(userid, list);
  final List list;
  String userid;
  // ignore: non_constant_identifier_names
  String consumer_username;
  ItemList({this.list, this.userid});
}

class _ItemListState extends State<ItemList> {
  // ignore: non_constant_identifier_names
  bool loading = false;
  final List list;
  // ignore: non_constant_identifier_names
  // String formatted;
  String userid;
  _ItemListState(this.userid, this.list);

  @override
  initState() {
    super.initState();
    this.setState(() {});
  }

  @override
  Widget build(BuildContext context) {
    return loading
        ? loadingSrc()
        : ListView.builder(
            itemCount: widget.list == null ? 0 : widget.list.length,
            itemBuilder: (context, i) {
              return new Container(
                child: new Card(
                    color: HexColor("#001125"),
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
                                  margin: EdgeInsets.only(top: 10),
                                  child: Column(
                                    children: <Widget>[
                                      Text("${widget.list[i]['service_name']}",
                                          style: TextStyle(
                                              color: Colors.white,
                                              fontSize: 18,
                                              fontWeight: FontWeight.bold)),
                                              new Row(
                            children: <Widget>[
                              Expanded(
                                child: Padding(
                                  padding: const EdgeInsets.only(
                                      left: 50.0, right: 50.0, top: 20.0),
                                  child: new Container(
                                    alignment: Alignment.center,
                                    child: Text("${widget.list[i]['service_des']}",
                                          style: TextStyle(
                                              color: Colors.white,
                                              fontSize: 15,
                                    )),
                                  ),
                                ),
                              )
                            ],
                          ),
                                              
                                    ],
                                  ),
                                ),
                              ),
                              Center(
                                child: MaterialButton(
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
                                        builder: (context) => Upload(
                                            userid: userid,
                                            vendorID: widget.list[i]
                                                ['vendorID'],
                                            service_id: widget.list[i]
                                                ['service_id'],
                                            user_email: widget.list[i]
                                                ['user_email']),
                                      ),
                                    );
                                  },
                                  child: Text(
                                    'Select',
                                    style: TextStyle(
                                        color: Colors.black,
                                        fontSize: 12,
                                        fontWeight: FontWeight.bold),
                                  ),
                                ),
                              )
                            ],
                          ),
                        )),
                      ],
                      crossAxisAlignment: CrossAxisAlignment.start,
                    )),
              );
            },
          );
  }
}
