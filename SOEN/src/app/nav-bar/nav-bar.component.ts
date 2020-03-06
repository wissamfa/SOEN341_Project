import { Component, OnInit } from '@angular/core';
import { faInstagram } from '@fortawesome/free-brands-svg-icons';
import { faCompass, faHeart, faUser } from '@fortawesome/free-regular-svg-icons'
import { faSearch } from '@fortawesome/free-solid-svg-icons';
import { GlobalEventsService } from '../global-events.service';

@Component({
  selector: 'app-nav-bar',
  templateUrl: './nav-bar.component.html',
  styleUrls: ['./nav-bar.component.css']
})
export class NavBarComponent implements OnInit {

  title = 'SOEN';
  instagram = faInstagram;
  search = faSearch;
  compass = faCompass;
  heart = faHeart;
  user = faUser;

  constructor(private globalEventsManager: GlobalEventsService) { 
    
}


  ngOnInit(): void {
  }

}
