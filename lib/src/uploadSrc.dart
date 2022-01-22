import 'package:flutter/material.dart';
import 'package:file_picker/file_picker.dart';
import 'dart:convert';
import 'dart:io';
import 'package:flushbar/flushbar.dart';
import 'package:path/path.dart';
import 'package:hexcolor/hexcolor.dart';
import 'package:http/http.dart' as http;
import 'package:date_time_picker/date_time_picker.dart';
import 'package:printdali/src/userhome.dart';
import 'API.dart';
import 'loadingSrc.dart';
import 'package:flutter/widgets.dart';

// ignore: must_be_immutable
class Upload extends StatefulWidget {
  @override
  UploadState createState() =>
      UploadState(userid, vendorID, service_id, user_email);

  // ignore: non_constant_identifier_names

  String userid;
  String vendorID;
  // ignore: non_constant_identifier_names
  String user_email;
  // ignore: non_constant_identifier_names
  String service_id;
  // ignore: non_constant_identifier_names
  Upload({this.userid, this.vendorID, this.service_id, this.user_email});
}

class UploadState extends State<Upload> {
  String value;
  String userid;
  String vendorID;
  // ignore: non_constant_identifier_names
  String service_id;
  // ignore: non_constant_identifier_names
  String user_email;
  UploadState(this.userid, this.vendorID, this.service_id, this.user_email);
  final _formKey = GlobalKey<FormState>();
  String pickupDateTime = "";
  bool loading = false;
  // ignore: non_constant_identifier_names
  String PayMethod;

  final numcopy = TextEditingController();
  final transnote = TextEditingController();
  String copytype;
  String status;
  String checkimg = "";
  // variable section
  List<Widget> fileListThumb;
  // ignore: deprecated_member_use
  List<File> fileList = new List<File>();

  Future pickFiles() async {
    // ignore: deprecated_member_use
    List<Widget> thumbs = new List<Widget>();
    fileListThumb.forEach((element) {
      thumbs.add(element);
    });

    await FilePicker.getMultiFile(
      type: FileType.custom,
      allowedExtensions: ['jpg', 'jpeg', 'bmp', 'pdf', 'doc', 'docx'],
    ).then((files) {
      if (files != null && files.length > 0) {
        files.forEach((element) {
          List<String> picExt = ['.jpg', '.jpeg', '.bmp'];

          if (picExt.contains(extension(element.path))) {
            thumbs.add(Padding(
                padding: EdgeInsets.all(1), child: new Image.file(element)));
          } else
            thumbs.add(Container(
                child: Column(
                    crossAxisAlignment: CrossAxisAlignment.center,
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: <Widget>[
                  Icon(Icons.insert_drive_file),
                  Text(extension(element.path))
                ])));
          fileList.add(element);
        });
        setState(() {
          fileListThumb = thumbs;
          checkimg = "notempty";
        });
      }
    });
  }

  List<Map> toBase64(List<File> fileList) {
    // ignore: deprecated_member_use
    List<Map> s = new List<Map>();
    if (fileList.length > 0)
      fileList.forEach((element) {
        Map a = {
          'fileName': basename(element.path),
          'encoded': base64Encode(element.readAsBytesSync()),
        };
        s.add(a);
      });
    return s;
  }

  Future<bool> httpSend(Map params) async {
    String endpoint =local_IP_Port + "Mobilelogin/uploadData";
    // ignore: missing_return
    return await http.post(endpoint, body: params).then((response) {
      // print(response.body);
      if (response.body == 'OK') {
        return true;
      } else
        return false;
    });
  }

  @override
  initState() {
    super.initState();
    this.setState(() {
      // print(userid);
    });
  }

  @override
  Widget build(BuildContext context) {
    if (fileListThumb == null)
      fileListThumb = [
        InkWell(
          onTap: pickFiles,
          child: Container(child: Icon(Icons.add)),
        )
      ];
    final Map params = new Map();
    return loading
        ? loadingSrc()
        : Scaffold(
            appBar: AppBar(
              centerTitle: true,
              title: Text("FORM"),
              iconTheme: IconThemeData(color: Colors.black),
              backgroundColor: HexColor("#ffbd59"),
            ),
            body: SingleChildScrollView(
              child: Form(
                key: _formKey,
                child: Column(
                  children: [
                    Column(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: <Widget>[
                          new Row(
                            children: [
                              Expanded(
                                  child: Padding(
                                      padding: const EdgeInsets.only(
                                          left: 20.0, right: 20.0, top: 5.0),
                                      child: new Container(
                                        alignment: Alignment.center,
                                        child: Text(
                                          'Files',
                                          style: TextStyle(
                                              fontWeight: FontWeight.w300,
                                              fontSize: 18.0,
                                              color: Color(0xFF162A49)),
                                        ),
                                      )))
                            ],
                          ),
                          new Row(
                            children: [
                              SingleChildScrollView(
                                  child: Column(
                                      mainAxisAlignment:
                                          MainAxisAlignment.center,
                                      children: <Widget>[
                                    Container(
                                      padding: const EdgeInsets.only(
                                          left: 50.0, right: 50.0, top: 20.0),
                                      width: 200,
                                      height: 200,
                                      child: GridView.count(
                                        crossAxisCount: 2,
                                        children: fileListThumb,
                                      ),
                                    )
                                  ]))
                            ],
                          ),
                          new Row(
                            children: [
                              Expanded(
                                  child: Padding(
                                      padding: const EdgeInsets.only(
                                          left: 50.0, right: 50.0, top: 20.0),
                                      child: new Container(
                                        alignment: Alignment.center,
                                        child: Text(
                                          'Pickup Date and Time',
                                          style: TextStyle(
                                              fontWeight: FontWeight.w300,
                                              fontSize: 18.0,
                                              color: Color(0xFF162A49)),
                                        ),
                                      )))
                            ],
                          ),
                          new Row(
                            children: <Widget>[
                              Expanded(
                                child: Padding(
                                  padding: const EdgeInsets.only(
                                      left: 50.0, right: 50.0, top: 0),
                                  child: new Container(
                                      alignment: Alignment.center,
                                      child: DateTimePicker(
                                        type:
                                            DateTimePickerType.dateTimeSeparate,
                                        dateMask: 'd MMM, yyyy',
                                        initialValue:
                                            DateTime(2021, 10, 6).toString(),
                                        firstDate: DateTime(2020, 6, 24),
                                        lastDate: DateTime(2100),
                                        icon: Icon(Icons.event),
                                        dateLabelText: 'Date',
                                        timeLabelText: "Hour",
                                        selectableDayPredicate: (date) {
                                          // Disable weekend days to select from the calendar
                                          if (date.weekday == 6 ||
                                              date.weekday == 7) {
                                            return false;
                                          }

                                          return true;
                                        },
                                        onChanged: (val) => print(val),
                                        validator: (val) {
                                          // print(val);
                                          setState(() {
                                            pickupDateTime = val;
                                          });
                                          return null;
                                        },
                                        onSaved: (val) => print(val),
                                      )),
                                ),
                              )
                            ],
                          ),
                          new Row(
                            children: [
                              Expanded(
                                  child: Padding(
                                      padding: const EdgeInsets.only(
                                          left: 50.0, right: 50.0, top: 20.0),
                                      child: new Container(
                                        alignment: Alignment.center,
                                        child: Text(
                                          'Type',
                                          style: TextStyle(
                                              fontWeight: FontWeight.w300,
                                              fontSize: 18.0,
                                              color: Color(0xFF162A49)),
                                        ),
                                      )))
                            ],
                          ),
                          new Row(
                            children: [
                              Expanded(
                                  child: Padding(
                                padding: const EdgeInsets.only(
                                    left: 100.0, right: 100.0, top: 10.0),
                                child: Container(
                                  alignment: Alignment.center,
                                  // padding: const EdgeInsets.all(0.0),
                                  child: DropdownButton<String>(
                                    value: copytype,
                                    //elevation: 5,
                                    style: TextStyle(color: Colors.black),

                                    items: <String>[
                                      'Colored',
                                      'Black',
                                    ].map<DropdownMenuItem<String>>(
                                        (String value) {
                                      return DropdownMenuItem<String>(
                                        value: value,
                                        child: Text(value),
                                      );
                                    }).toList(),
                                    hint: Center(
                                      child: Text(
                                        "----",
                                        style: TextStyle(
                                            color: Colors.black,
                                            fontSize: 16,
                                            fontWeight: FontWeight.w600),
                                      ),
                                    ),

                                    onChanged: (String text) {
                                      setState(() {
                                        copytype = text;
                                      });
                                    },
                                  ),
                                ),
                              )),
                            ],
                          ),
                          new Row(
                            children: [
                              Expanded(
                                  child: Padding(
                                      padding: const EdgeInsets.only(
                                          left: 50.0, right: 50.0, top: 20.0),
                                      child: new Container(
                                        alignment: Alignment.center,
                                        child: Text(
                                          'Number of Copies',
                                          style: TextStyle(
                                              fontWeight: FontWeight.w300,
                                              fontSize: 18.0,
                                              color: Color(0xFF162A49)),
                                        ),
                                      )))
                            ],
                          ),
                          new Row(
                            children: <Widget>[
                              Expanded(
                                child: Padding(
                                  padding: const EdgeInsets.only(
                                      left: 50.0, right: 50.0, top: 10.0),
                                  child: new Container(
                                    alignment: Alignment.center,
                                    child: TextFormField(
                                      // user keyboard will have a button to move cursor to next line

                                      controller: numcopy,
                                      validator: (value) {
                                        if (value.isEmpty) {
                                          return 'Required!';
                                        }
                                        return null;
                                      },
                                      decoration: InputDecoration(
                                        hintText: "Number",
                                      ),
                                    ),
                                  ),
                                ),
                              )
                            ],
                          ),
                          new Row(
                            children: [
                              Expanded(
                                  child: Padding(
                                      padding: const EdgeInsets.only(
                                          left: 50.0, right: 50.0, top: 20.0),
                                      child: new Container(
                                        alignment: Alignment.center,
                                        child: Text(
                                          'Note',
                                          style: TextStyle(
                                              fontWeight: FontWeight.w300,
                                              fontSize: 18.0,
                                              color: Color(0xFF162A49)),
                                        ),
                                      )))
                            ],
                          ),
                          new Row(
                            children: <Widget>[
                              Expanded(
                                child: Padding(
                                  padding: const EdgeInsets.only(
                                      left: 50.0, right: 50.0, top: 10.0),
                                  child: new Container(
                                    alignment: Alignment.center,
                                    child: TextFormField(
                                      validator: (value) {
                                        if (value.isEmpty) {
                                          return 'Required!';
                                        }
                                        return null;
                                      },
                                      decoration: InputDecoration(
                                        hintText: "Note",
                                      ),
                                      controller: transnote,
                                    ),
                                  ),
                                ),
                              )
                            ],
                          ),
                          new Row(
                            children: [
                              Expanded(
                                  child: Padding(
                                      padding: const EdgeInsets.only(
                                          left: 50.0, right: 50.0, top: 20.0),
                                      child: new Container(
                                        alignment: Alignment.center,
                                        child: Text(
                                          'Payment',
                                          style: TextStyle(
                                              fontWeight: FontWeight.w300,
                                              fontSize: 18.0,
                                              color: Color(0xFF162A49)),
                                        ),
                                      )))
                            ],
                          ),
                          new Row(
                            children: [
                              Expanded(
                                  child: Padding(
                                padding: const EdgeInsets.only(
                                    left: 50.0, right: 50.0, top: 10.0),
                                child: Container(
                                  alignment: Alignment.center,
                                  // padding: const EdgeInsets.all(0.0),
                                  child: DropdownButton<String>(
                                    value: PayMethod,
                                    //elevation: 5,
                                    style: TextStyle(color: Colors.black),

                                    items: <String>[
                                      'Pay later',
                                      'G-cash',
                                    ].map<DropdownMenuItem<String>>(
                                        (String value) {
                                      return DropdownMenuItem<String>(
                                        value: value,
                                        child: Text(value),
                                      );
                                    }).toList(),
                                    hint: Center(
                                      child: Text(
                                        "Payment method",
                                        style: TextStyle(
                                            color: Colors.black,
                                            fontSize: 16,
                                            fontWeight: FontWeight.w600),
                                      ),
                                    ),

                                    onChanged: (String text) {
                                      setState(() {
                                        PayMethod = text;
                                      });
                                    },
                                  ),
                                ),
                              )),
                            ],
                          ),
                          new Row(
                            children: <Widget>[
                              Expanded(
                                child: Padding(
                                  padding: const EdgeInsets.only(
                                      left: 50.0,
                                      right: 50.0,
                                      top: 20.0,
                                      bottom: 30),
                                  child: new Container(
                                    child: Align(
                                      alignment: Alignment.center,
                                      child: Material(
                                        borderRadius:
                                            BorderRadius.circular(40.0),
                                        color: HexColor("#ffbd59"),
                                        child: MaterialButton(
                                          padding: const EdgeInsets.only(
                                              left: 50.0, right: 50.0),
                                          onPressed: () async {
                                            if (_formKey.currentState
                                                .validate()) {
                                              if (PayMethod == null ||
                                                  PayMethod == "" ||
                                                  pickupDateTime == null ||
                                                  pickupDateTime == "" ||
                                                  checkimg == "") {
                                                Flushbar(
                                                  message: "Error !",
                                                  icon: Icon(
                                                    Icons.error_outline,
                                                    size: 28.0,
                                                    color: Colors.blue[300],
                                                  ),
                                                  duration:
                                                      Duration(seconds: 3),
                                                  leftBarIndicatorColor:
                                                      Colors.blue[300],
                                                ).show(context);
                                              } else {
                                                List<Map> attch =
                                                    toBase64(fileList);
                                                params["attachment"] =
                                                    jsonEncode(attch);
                                                params["vendorID"] =
                                                    jsonEncode(vendorID);
                                                params["user_id"] =
                                                    jsonEncode(userid);
                                                params["service_id"] =
                                                    jsonEncode(service_id);
                                                params["payment_method"] =
                                                    jsonEncode(PayMethod);
                                                params["pickupDateandTime"] =
                                                    jsonEncode(pickupDateTime);
                                                params["user_email"] =
                                                    jsonEncode(user_email);
                                                params["transactionNote"] =
                                                    jsonEncode(transnote.text);
                                                params["numbercopy"] =
                                                    jsonEncode(numcopy.text);
                                                params["colortype"] =
                                                    jsonEncode(copytype);
                                                httpSend(params).then((sukses) {
                                                  if (sukses == true) {
                                                    Navigator.push(
                                                      context,
                                                      MaterialPageRoute(
                                                        builder: (context) =>
                                                            userhome(
                                                                userid: userid,
                                                                service_id:
                                                                    service_id,
                                                                user_email:
                                                                    user_email),
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
                                                      duration:
                                                          Duration(seconds: 3),
                                                      leftBarIndicatorColor:
                                                          Colors.red[300],
                                                    ).show(context);
                                                });
                                              }
                                            }
                                          },
                                          child: Text(
                                            'Submit',
                                            style: TextStyle(
                                                color: Colors.black,
                                                fontWeight: FontWeight.bold),
                                          ),
                                        ),
                                      ),
                                    ),
                                  ),
                                ),
                              )
                            ],
                          ),
                        ]),
                  ],
                ),
              ),
            ));
  }
}
