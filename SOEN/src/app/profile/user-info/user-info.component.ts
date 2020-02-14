import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-user-info',
  templateUrl: './user-info.component.html',
  styleUrls: ['./user-info.component.css']
})
export class UserInfoComponent implements OnInit {
  @Input() userData;
  @Output() refreshUserInfo = new EventEmitter<any>();
  userLoggedIN: any;

  constructor(
    ) {}

  ngOnInit() {
    console.log(this.userData);
    
  }

}
