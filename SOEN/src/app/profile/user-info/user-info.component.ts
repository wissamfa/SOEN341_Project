import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { AuthService } from 'src/app/shared/services/auth.service';
import { GlobalEventsService } from 'src/app/global-events.service';

@Component({
  selector: 'app-user-info',
  templateUrl: './user-info.component.html',
  styleUrls: ['./user-info.component.css']
})
export class UserInfoComponent implements OnInit {
  @Input() userData;
  @Output() refreshUserInfo = new EventEmitter<any>();

  constructor(private auth: AuthService, private globalEvents: GlobalEventsService) {}

  ngOnInit() {
  }

  logout() {
    this.auth.doLogout();
    this.globalEvents.showNavBar(false);
  }

}
