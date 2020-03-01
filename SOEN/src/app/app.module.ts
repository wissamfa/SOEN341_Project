import { BrowserModule } from "@angular/platform-browser";
import { NgModule } from "@angular/core";

import { AppRoutingModule } from "./app-routing.module";
import { AppComponent } from "./app.component";

import { LoginComponent } from "./login/login.component";
import { ReactiveFormsModule, FormsModule } from "@angular/forms";
import { BrowserAnimationsModule } from "@angular/platform-browser/animations";
import { ProfileComponent } from "./profile/profile.component";
import { UserInfoComponent } from "./profile/user-info/user-info.component";
import { RegisterComponent } from "./register/register.component";
import { ForgetModule } from "./forget/forget.module";
import { MatToolbarModule } from "@angular/material/toolbar";
import { MatButtonModule } from "@angular/material/button";

import { FontAwesomeModule } from "@fortawesome/angular-fontawesome";
import { ListOfPostsComponent } from "./profile/list-of-posts/list-of-posts.component";
import { PostDialogComponent } from "./post-dialog/post-dialog.component";

import { MatDialogModule } from "@angular/material/dialog";

// Firebas
import { AngularFireModule } from '@angular/fire';
import { AngularFirestoreModule } from '@angular/fire/firestore';
import { AngularFireAuthModule } from '@angular/fire/auth';
import { AngularFireDatabaseModule} from '@angular/fire/database';
import { NavBarComponent } from './nav-bar/nav-bar.component';
import { NewsfeedComponent } from './newsfeed/newsfeed.component';



const environment = {
  apiKey: "AIzaSyD0vaeU3okn8C1W-AuH7GJaj1GAXLeFfco",
  authDomain: "soen341-project.firebaseapp.com",
  databaseURL: "https://soen341-project.firebaseio.com",
  projectId: "soen341-project",
  storageBucket: "soen341-project.appspot.com",
  messagingSenderId: "792011547652",
  appId: "1:792011547652:web:57ba8ab0524a085660c151",
  measurementId: "G-Y3ZVXB2FVK"
}

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    ProfileComponent,
    UserInfoComponent,
    RegisterComponent,
    ListOfPostsComponent,
    PostDialogComponent,
    NavBarComponent,
    NewsfeedComponent
  ],
  imports: [
    AngularFireModule.initializeApp(environment),
    AngularFirestoreModule,
    AngularFireAuthModule,
    AngularFireDatabaseModule,
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    BrowserAnimationsModule,
    ForgetModule,
    MatButtonModule,
    MatToolbarModule,
    FontAwesomeModule,
    MatDialogModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule {}
