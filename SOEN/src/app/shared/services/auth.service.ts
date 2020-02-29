import { Injectable } from "@angular/core";
import { AngularFireAuth } from "@angular/fire/auth";
import * as firebase from "firebase/app";
import { Router } from '@angular/router';

@Injectable({
  providedIn: "root"
})
export class AuthService {

  user: any;
  constructor(public afAuth: AngularFireAuth, private route: Router) {}

  doRegister(value) {
    return new Promise<any>((resolve, reject) => {
      firebase
        .auth()
        .createUserWithEmailAndPassword(value.email, value.password)
        .then(
          res => {
            resolve(res);
          },
          err => reject(err)
        );
    });
  }

  doLogin(value) {
    return new Promise<any>((resolve, reject) => {
      firebase
        .auth()
        .signInWithEmailAndPassword(value.email, value.password)
        .then(
          res => {
            resolve(res);
            this.user = res;
          },
          err => reject(err)
        );
    });
  }

  doLogout() {
    return new Promise((resolve) => {
      firebase.auth().signOut();
      this.route.navigate(['']);
      resolve();
    });
  }
}
