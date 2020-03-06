import { Component, OnInit } from '@angular/core';
import { faHeart, faComment } from '@fortawesome/free-regular-svg-icons'

@Component({
  selector: 'app-timeline',
  templateUrl: './timeline.component.html',
  styleUrls: ['./timeline.component.css']
})
export class TimelineComponent implements OnInit {
  posts: Array<Object>;
  heart = faHeart;
  comment = faComment;

  post = {
    id: 1,
    numberOfLikes: 10,
    numberOfComments: 5,
    imageUrl: "https://www.aviatorcameragear.com/wp-content/uploads/2012/07/placeholder_2.jpg",
    comments: [
      { username: "username", userId: 1, comment: "this is a comment", 'imageUrl': 'data:image/jpeg;base64,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' },
      { username: "username", userId: 1, comment: "this is a comment", 'imageUrl': 'data:image/jpeg;base64,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' }
    ],
    likes: [
      { username: "name", userId: 1 },
      { username: "name", userId: 1 },
      { username: "name", userId: 1 }
    ]
  };

  constructor() { }

  ngOnInit(): void {
    this.posts = [
      { 'id': 1, 'numberOfLikes': 0, 'numberOfComments': 0, 'imageUrl': ''},
      { 'id': 2, 'numberOfLikes': 0, 'numberOfComments': 0, 'imageUrl': ''},
      { 'id': 3,'numberOfLikes': 0, 'numberOfComments': 0, 'imageUrl': ''},
    ];
  }

  

}
