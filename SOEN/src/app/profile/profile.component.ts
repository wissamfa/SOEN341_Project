import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {
  userPosts: any;
  userData: any;

  user = {};
  likesListProfile = [];

  constructor(
    private router: ActivatedRoute,
  ) {
  }

  ngOnInit() {
    this.user = {
      'username': 'Brad Pitt',
      'name': 'Brad',
      'posts': 20,
      'followers': 1500,
      'following': 700,
      'bio': 'This is my bio'
    };

    this.userPosts = [
      { 'numberOfLikes': 0, 'numberOfComments': 0, 'imageUrl': 'http://tiny.cc/pv5jkz'},
      { 'numberOfLikes': 0, 'numberOfComments': 0, 'imageUrl': 'http://tiny.cc/jw5jkz'},
      { 'numberOfLikes': 0, 'numberOfComments': 0, 'imageUrl': ''},
    ]
  }

}
