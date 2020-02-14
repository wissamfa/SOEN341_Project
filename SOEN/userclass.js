class User {

constructor(username, password){
    this.username = username;
    this.password = password;
}

set set_username(userName){
    this.username = userName;
}

set set_password(passWord){
    this.password = passWord;
}

//temporary function details, to fix later
login(){
    console.login(this.username, 'log in successful!');
}

//temporary function details, to fix later
login(){
    console.logout(this.username, 'log out successful!');
}

}

var user_one = new User('noamanf123', 'password456');
var user_two = new User('king13', 'kingzisland75');
