import 'package:flutter/material.dart';
import 'package:printdali/src/signupSrc.dart';
import 'loadingSrc.dart';
import 'package:hexcolor/hexcolor.dart';

import 'loginSrc.dart';

// ignore: camel_case_types
class MainSrc extends StatefulWidget {
  static String tag = 'login';
  _MainSrcState createState() => _MainSrcState();
}

// ignore: camel_case_types
class _MainSrcState extends State<MainSrc> {
  // String id;
  // final db = Firestore.instance;
  String value;
  final _formKey = GlobalKey<FormState>();
  bool loading = false;

  String status;

  @override
  Widget build(BuildContext context) {
    return loading
        ? loadingSrc()
        : Scaffold(
            backgroundColor: HexColor("#ffbd59"),
            body: Center(
              child: SingleChildScrollView(
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: <Widget>[
                    Container(
                      margin: const EdgeInsets.only(
                        top: 10.0,
                      ),
                      child: Image.asset(
                        'assets/img/logo_white.png',
                        height: 250,
                        width: 250,
                      ),
                    ),
                    new Row(
                      children: <Widget>[
                        Expanded(
                          child: Padding(
                            padding: const EdgeInsets.only(
                                left: 40.0, right: 40.0, top: 180.0),
                            child: new Container(
                              child: Material(
                                borderRadius: BorderRadius.circular(40.0),
                                color: Colors.white,
                                child: MaterialButton(
                                  onPressed: () {
                                    Navigator.push(
                                        context,
                                        MaterialPageRoute(
                                            builder: (context) => loginSrc()));
                                  },
                                  minWidth: 40.0,
                                  height: 30.0,
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
                        )
                      ],
                    ),
                    new Row(
                      children: <Widget>[
                        Expanded(
                          child: Padding(
                            padding: const EdgeInsets.only(
                                left: 40.0, right: 40.0, top: 20.0),
                            child: new Container(
                              child: Material(
                                borderRadius: BorderRadius.circular(40.0),
                                color: Colors.white,
                                child: MaterialButton(
                                  onPressed: () {
                                    Navigator.push(
                                        context,
                                        MaterialPageRoute(
                                            builder: (context) => signupSrc()));
                                  },
                                  minWidth: 40.0,
                                  height: 30.0,
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
                        )
                      ],
                    ),
                  ],
                ),
              ),
            ));
  }
}
