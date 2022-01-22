import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:footer/footer.dart';
import 'package:footer/footer_view.dart';
import 'package:hexcolor/hexcolor.dart';
import 'package:http/http.dart' as http;
import 'package:printdali/src/signupSrc.dart';

import 'API.dart';
import 'homeSrc.dart';
import 'loadingSrc.dart';

class loginSrc extends StatefulWidget {
  @override
  loginSrcState createState() {
    return new loginSrcState();
  }
}

// ignore: camel_case_types
class loginSrcState extends State<loginSrc> {
  String value;
  final _formKey = GlobalKey<FormState>();
  final password = TextEditingController();
  final username = TextEditingController();
  bool loading = false;

  String status;
  @override
  Widget build(BuildContext context) {
    return loading
        ? loadingSrc()
        : Scaffold(
            appBar: AppBar(
              centerTitle: true,
              iconTheme: IconThemeData(color: Colors.black),
              backgroundColor: Colors.white,
            ),
            body: Form(
              key: _formKey,
              child: FooterView(
                  children: <Widget>[
                    SingleChildScrollView(
                      child: Column(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: <Widget>[
                          new Row(
                            children: <Widget>[
                              Expanded(
                                child: Padding(
                                  padding: const EdgeInsets.only(
                                      left: 50.0, right: 50.0, top: 20.0),
                                  child: new Container(
                                    alignment: Alignment.center,
                                    child: TextFormField(
                                      validator: (value) {
                                        if (value.isEmpty) {
                                          return 'Enter your Username';
                                        }
                                        return null;
                                      },
                                      decoration: InputDecoration(
                                        border: OutlineInputBorder(
                                          borderRadius:
                                              BorderRadius.circular(40.0),
                                        ),
                                        hintText: "Username",
                                      ),
                                      onChanged: (text) {
                                        value = text;
                                      },
                                      controller: username,
                                    ),
                                  ),
                                ),
                              )
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
                                        if (value.length < 8) {
                                          if (value.isEmpty) {
                                            return 'Password is empty';
                                          } else {
                                            return 'Atleast 8 character';
                                          }
                                        }

                                        return null;
                                      },
                                      obscureText: true,
                                      decoration: InputDecoration(
                                        border: OutlineInputBorder(
                                          borderRadius:
                                              BorderRadius.circular(40.0),
                                        ),
                                        hintText: "Password",
                                      ),
                                      controller: password,
                                    ),
                                  ),
                                ),
                              )
                            ],
                          ),
                          new Row(
                            children: <Widget>[
                              Expanded(
                                child: Padding(
                                  padding: const EdgeInsets.only(
                                      left: 50.0, right: 50.0, top: 10.0),
                                  child: new Container(
                                    child: Align(
                                      alignment: Alignment.centerRight,
                                      child: Text(
                                        'Forgot password',
                                        style:
                                            TextStyle(color: Colors.blue[900]),
                                      ),
                                    ),
                                  ),
                                ),
                              )
                            ],
                          ),
                          new Row(
                            children: <Widget>[
                              Expanded(
                                child: Padding(
                                  padding: const EdgeInsets.only(
                                      left: 50.0, right: 50.0, top: 10.0),
                                  child: new Container(
                                    child: Align(
                                      alignment: Alignment.centerRight,
                                      child: Material(
                                        borderRadius:
                                            BorderRadius.circular(40.0),
                                        color: HexColor("#ffbd59"),
                                        child: MaterialButton(
                                          padding: const EdgeInsets.only(
                                              left: 50.0, right: 50.0),
                                          onPressed: () {
                                            if (_formKey.currentState
                                                .validate()) {
                                                  setState(() {
                                                                                                      loading = true;
                                                                                                    });
                                              login();
                                            }
                                          },
                                          child: Text(
                                            'Login',
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
                        ], //this take an interger that ranges from 1-10 with 2 being the default for the Footer Area
                      ),
                    ),
                  ],
                  footer: new Footer(
                    child: new Column(
                        crossAxisAlignment: CrossAxisAlignment.center,
                        children: <Widget>[
                          Text(
                            'FAQ  |  Terms of Services',
                            style: TextStyle(
                                fontWeight: FontWeight.w300,
                                fontSize: 12.0,
                                color: Color(0xFF162A49)),
                          ),
                        ]),
                  )),
            ));
  }

  void login() async {
    var url =
        Uri.parse(local_IP_Port + "Mobilelogin/login");

    var result = await http.post(url, body: {
      "password": password.text,
      "username": username.text,
    });

    var myInt = result.body;
    print(myInt);
    if (myInt == "500") {
      setState(
        () => loading = false,
      );
      showDialog(
        context: context,
        builder: (BuildContext context) {
          // return object of type Dialog
          return AlertDialog(
            // title: new Text("Username Exist!"),
            content: new Text("Invalid Account"),
            actions: <Widget>[
              // usually buttons at the bottom of the dialog
              new MaterialButton(
                child: new Text("Close"),
                onPressed: () {
                  Navigator.of(context).pop();
                },
              ),
              new MaterialButton(
                child: new Text("Create Account"),
                onPressed: () {
                  Navigator.push(context,
                      MaterialPageRoute(builder: (context) => signupSrc()));
                },
              ),
            ],
          );
        },
      );
    } else {
      String arrayText = '[' + (result.body).toString() + ']';

      var tagsJson = jsonDecode(arrayText);
      List<dynamic> userInfo = tagsJson != null ? List.from(tagsJson) : null;

      print(userInfo[0]['user_id']);
      
      setState(
        () => loading = true,
      );
      Navigator.push(
          context,
          MaterialPageRoute(
              builder: (context) => homeSrc(userid: userInfo[0]['user_id'])));
    }
  }
}
