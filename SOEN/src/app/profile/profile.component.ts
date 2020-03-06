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
      'username': 'Username',
      'name': 'Name',
      'posts': "X",
      'followers': "X",
      'following': "X",
      'bio': 'This is a sample bio'
    };

    this.userPosts = [
      { 'id': 1, 'numberOfLikes': 0, 'numberOfComments': 0, 'imageUrl': ''},
      { 'id': 2, 'numberOfLikes': 0, 'numberOfComments': 0, 'imageUrl': ''},
      { 'id': 3,'numberOfLikes': 0, 'numberOfComments': 0, 'imageUrl': ''},
    ]
  }

}
