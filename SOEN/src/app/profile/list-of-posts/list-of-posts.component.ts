import { Component, OnInit, Input } from '@angular/core';
import { faComment, faHeart } from '@fortawesome/free-regular-svg-icons'

@Component({
  selector: 'app-list-of-posts',
  templateUrl: './list-of-posts.component.html',
  styleUrls: ['./list-of-posts.component.css']
})
export class ListOfPostsComponent implements OnInit {

  @Input() posts;
  heart = faHeart;
  comment = faComment;

  constructor() { }

  ngOnInit(): void {
  }

}
