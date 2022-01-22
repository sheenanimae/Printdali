import 'package:flutter/material.dart';
import 'package:footer/footer.dart';
import 'package:footer/footer_view.dart';
import 'package:hexcolor/hexcolor.dart';
import 'package:http/http.dart' as http;
import 'package:printdali/src/loginSrc.dart';

import 'API.dart';
import 'loadingSrc.dart';

class signupSrc extends StatefulWidget {
  @override
  signupSrcState createState() {
    return new signupSrcState();
  }
}

// ignore: camel_case_types
class signupSrcState extends State<signupSrc> {
  String value;
  final _formKey = GlobalKey<FormState>();
  final fname = TextEditingController();
  final lname = TextEditingController();
  final contactnumber = TextEditingController();
  final password = TextEditingController();
  final username = TextEditingController();
  final email = TextEditingController();
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
            body: FooterView(
                children: <Widget>[
                  Form(
                    key: _formKey,
                    child: SingleChildScrollView(
                      child: Column(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: <Widget>[
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
                                          return 'Enter your First name';
                                        }
                                        return null;
                                      },
                                      decoration: InputDecoration(
                                        border: OutlineInputBorder(
                                          borderRadius:
                                              BorderRadius.circular(40.0),
                                        ),
                                        hintText: "First Name",
                                      ),
                                      onChanged: (text) {
                                        value = text;
                                      },
                                      controller: fname,
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
                                        if (value.isEmpty) {
                                          return 'Enter your Last Name';
                                        }
                                        return null;
                                      },
                                      decoration: InputDecoration(
                                        border: OutlineInputBorder(
                                          borderRadius:
                                              BorderRadius.circular(40.0),
                                        ),
                                        hintText: "Last Name",
                                      ),
                                      onChanged: (text) {
                                        value = text;
                                      },
                                      controller: lname,
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
                                        if (value.isEmpty) {
                                          return 'Enter your email';
                                        }
                                        return null;
                                      },
                                      decoration: InputDecoration(
                                        border: OutlineInputBorder(
                                          borderRadius:
                                              BorderRadius.circular(40.0),
                                        ),
                                        hintText: "Email",
                                      ),
                                      onChanged: (text) {
                                        value = text;
                                      },
                                      controller: email,
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
                                        if (value.isEmpty) {
                                          return 'Enter your Contact Number';
                                        }
                                        return null;
                                      },
                                      decoration: InputDecoration(
                                        border: OutlineInputBorder(
                                          borderRadius:
                                              BorderRadius.circular(40.0),
                                        ),
                                        hintText: "Contact Number",
                                      ),
                                      onChanged: (text) {
                                        value = text;
                                      },
                                      controller: contactnumber,
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
                                    alignment: Alignment.center,
                                    height: 70.0,
                                    child: TextFormField(
                                        validator: (value) {
                                          if (value != password.text) {
                                            return 'Password not match';
                                          }
                                          return null;
                                        },
                                        obscureText: true,
                                        decoration: InputDecoration(
                                          border: OutlineInputBorder(
                                            borderRadius:
                                                BorderRadius.circular(40.0),
                                          ),
                                          hintText: "Re-Password",
                                        )),
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
                                              signup();
                                            }
                                          },
                                          child: Text(
                                            'Create Account',
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
          );
  }

  void signup() async {
    var url =
        Uri.parse(local_IP_Port + "Mobilelogin/signup");

    var result = await http.post(url, body: {
      "fname": fname.text,
      "lname": lname.text,
      "password": password.text,
      "username": username.text,
      "email": email.text,
      "contactnumber": contactnumber.text
    });
    var resultData = result.body;
    print(resultData);
    setState(() {
          loading=false;
        });
    if (resultData == "U500") {
      showDialog(
        context: context,
        builder: (BuildContext context) {
          // return object of type Dialog
          return AlertDialog(
            title: new Text("Username Exist!"),
            content: new Text("Try another Username"),
            actions: <Widget>[
              // usually buttons at the bottom of the dialog
              new MaterialButton(
                child: new Text("Close"),
                onPressed: () {
                  Navigator.of(context).pop();
                },
              ),
            ],
          );
        },
      );
    } else if (resultData == "E500") {
      showDialog(
        context: context,
        builder: (BuildContext context) {
          // return object of type Dialog
          return AlertDialog(
            title: new Text("Email Exist!"),
            content: new Text("Try another Email"),
            actions: <Widget>[
              // usually buttons at the bottom of the dialog
              new MaterialButton(
                child: new Text("Close"),
                onPressed: () {
                  Navigator.of(context).pop();
                },
              ),
            ],
          );
        },
      );
    } else if (resultData == "200") {
      setState(
        () => loading = true,
      );
      showDialog(
        context: context,
        builder: (BuildContext context) {
          // return object of type Dialog
          return AlertDialog(
            // title: new Text("Username Exist!"),
            content: new Text("Created Successfuly"),
            actions: <Widget>[
              // usually buttons at the bottom of the dialog
              new MaterialButton(
                child: new Text("Close"),
                onPressed: () {
                  Navigator.push(context,
                      MaterialPageRoute(builder: (context) => loginSrc()));
                },
              ),
            ],
          );
        },
      );
    } else {
      showDialog(
        context: context,
        builder: (BuildContext context) {
          // return object of type Dialog
          return AlertDialog(
            title: new Text("Error!"),
            content:
                new Text("Error Adding your account Please try again Later."),
            actions: <Widget>[
              // usually buttons at the bottom of the dialog
              new MaterialButton(
                child: new Text("Close"),
                onPressed: () {
                  Navigator.of(context).pop();
                },
              ),
            ],
          );
        },
      );
    }
  }
}
