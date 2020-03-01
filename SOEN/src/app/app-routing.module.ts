import { NgModule } from "@angular/core";
import { Routes, RouterModule } from "@angular/router";
import { LoginComponent } from "./login/login.component";
import { ProfileComponent } from "./profile/profile.component";
import { RegisterComponent } from "./register/register.component";
import { ForgetComponent } from "./forget/pages/forget.component";
import { NavBarComponent } from './nav-bar/nav-bar.component';

const routes: Routes = [
  {
    path: "",
    component: LoginComponent,
    children: [
      {
        path: "dashboard",
        component: NavBarComponent
      }
    ]
  },
  { path: "register", component: RegisterComponent },
  { path: "profile", component: ProfileComponent },
  { path: "forget", component: ForgetComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}
