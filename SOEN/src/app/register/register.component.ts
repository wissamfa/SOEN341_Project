import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from '../shared/services/auth.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {

  selectedFile: ImageSnippet;
  registerForm: FormGroup;
  url;

  submitted = false;
  registeredUser = {};

  constructor(
        private formBuilder: FormBuilder,
        private router: Router,
        private auth: AuthService
        ) {}


  // To validate that the user had filled up the info to register
  ngOnInit() {
    this.registerForm = this.formBuilder.group({
      username: [''],
      password: ['', [Validators.required, Validators.minLength(6)]],
      confirmPassword: ['', Validators.required],
      userAge: ['', Validators.required],
      email: ['', [Validators.required, Validators.email]]
    });
  }



  // This function will call the validation to make sure all the fields are filled before sending it to the backend
  checkup() {
    this.register_User();
  }
  // For sending the info of the user to the backend:
  register_User() {
    const value = {
      email: this.registerForm.get("email").value,
      password: this.registerForm.get("password").value,
    }
    this.auth.doRegister(value).then(
      res => {
        this.router.navigate(['']);
    },
    err => {
      console.error(err);
    })
  }


  // convenience getter for easy access to form fields
  get g() { return this.registerForm.controls; }

 // Uploading profile image
  readUrl(event:any) {
    if (event.target.files && event.target.files[0]) {
      const READER = new FileReader();

      READER.onload = (event: ProgressEvent) => {
        this.url = (<FileReader>event.target).result;
      };
      READER.readAsDataURL(event.target.files[0]);
    }
  }

  private onSuccess() {
    this.selectedFile.pending = false;
    this.selectedFile.status = 'ok';
  }

  private onError() {
    this.selectedFile.pending = false;
    this.selectedFile.status = 'fail';
    this.selectedFile.src = '';
  }

  processFile(imageInput: any) {
    const file: File = imageInput.files[0];
    const reader = new FileReader();

    reader.addEventListener('load', (event: any) => {

      this.selectedFile = new ImageSnippet(event.target.result, file);

      this.selectedFile.pending = true;
    });

    reader.readAsDataURL(file);
  }
}
class ImageSnippet {
  pending: Boolean = false;
  status: String = 'init';
  constructor(public src: string, public file: File) {}
}
