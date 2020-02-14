import { Component, OnInit, ViewChild, ElementRef } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {
  witObject = {};
  replyObject = {};
  @ViewChild('replyPost') replyPost: ElementRef;
  @ViewChild('witPost') witPost: ElementRef;

  userWits: any;
  userData: any;
  likesOfWits: any;
  listOfFollowing: any;
  listOfFollowers: any;
  likedWits: any;
  userLoggedIN: any;
  userObj: any = {};

  user = {};
  likesListProfile = [];

  constructor(
    // private snackBar: MatSnackBar,
    private router: ActivatedRoute,
  ) {
  }

  ngOnInit() {
    this.user = {
      'username': 'wissam'
    };
    console.log(this.user);
    
  }

}
