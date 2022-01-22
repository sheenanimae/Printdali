import 'package:flutter/material.dart';
import 'package:printdali/src/MainSrc.dart';

void main() => runApp(MyApp());

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: "APP",
      debugShowCheckedModeBanner: false,
      home: MainSrc(),
    );
  }
}

