import { Component, OnInit, Input } from '@angular/core';
import { faComment, faHeart } from '@fortawesome/free-regular-svg-icons'
import { MatDialog } from '@angular/material/dialog';
import { PostDialogComponent } from 'src/app/post-dialog/post-dialog.component';

@Component({
  selector: 'app-list-of-posts',
  templateUrl: './list-of-posts.component.html',
  styleUrls: ['./list-of-posts.component.css']
})
export class ListOfPostsComponent implements OnInit {

  @Input() posts;
  heart = faHeart;
  comment = faComment;

  constructor(
    private dialog: MatDialog
  ) { }

  ngOnInit(): void {
  }

  openImageDialog(id: Number) {
    this.dialog.open(PostDialogComponent, {
      data: {
        'postId': id
      }
    })
  }

}
