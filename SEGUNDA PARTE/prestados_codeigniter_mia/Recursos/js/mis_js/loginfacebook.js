  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1641276056121651', // Set YOUR APP ID
      channelUrl : 'https://prestados-ci-matialvarezs.c9.io/index.php/prestamosc', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true,  // parse XFBML
      version    :  'v2.5',
      //scope: 'read_friendlists,public_profile,email,user_friends,read_friendlists'
      scope: 'email'
    });
 
    FB.Event.subscribe('auth.authResponseChange', function(response) 
    {
     if (response.status === 'connected') 
    {
        
        document.getElementById("message").innerHTML +=  "<br>Connected to Facebook";
        //SUCCESS
 
    }    
    else if (response.status === 'not_authorized') 
    {
        document.getElementById("message").innerHTML +=  "<br>Failed to Connect";
 
        //FAILED
    } else 
    {
        document.getElementById("message").innerHTML +=  "<br>Logged Out";
 
        //UNKNOWN ERROR
    }
    }); 
 
    };
 
 
//  FB.login(function(response) 
//  {
//     if (response.authResponse) 
//     {
//         window.location.reload();
//     }
// }, {scope:'email,user_friends'});
 
//  function getFriends() {
//     FB.api('/me/friends', function(response) {
//         if(response.data) {
//             $.getJSON(response.data,function(index,friend) {
//                 alert(friend.name + ' has id:' + friend.id);
//                 document.getElementById("message").innerHTML +=  "<br>"+response.data;
//             });
//         } else {
//             //alert("Error!");
//             document.getElementById("message").innerHTML +=  "<br>ERROR LISTADO DE AMIGOS";
//         }
//     },{scope: 'user_friends,email,user_photos,user_videos'});
// }

//  function getFriends2() {
//   FB.api('/me', function(response) {
//       FB.api(response.id+'/friends', function(response) {
//           $(document.body).prepend('<div class="test-list" style="position: fixed; z-index: 99999999; left: 50%; overflow: scroll; height: 500px; top: 25%;"></div>')
//           for (var i=0; i < response.data.length; i++) { 
//             FB.api('/'+response.data[i].id, function(response) {
//               if(response.gender === 'male') {
//                   $('.test-list').prepend('<li>'+response.name+'</li>');
//               }
//             });
//           }         
//       });
//   });
// }

// function getFriends3(){

//     FB.api('/me?fields=friends.fields(gender,id,name)', function(response) {
//       console.log(response);
//       document.getElementById("message").innerHTML +=response;
//     });

// }

// function getAmigos(usuario,token)
// {
//      var resp = $.getJSON('https://graph.facebook.com/'+usuario+'/friends?limit=100&access_token='+token, function(mydata) {
//         var output="<ul>";
//         for (var i in mydata.data) {
//             output+="<li>NAMA : " + mydata.data[i].name + "<br/>ID : " + mydata.data[i].id + "</li>";
//         }
 
//         output+="</ul>";
    
//         document.getElementById("placeholder").innerHTML=output;   });
 
//     // $.get("https://graph.facebook.com/me/friends",
//     // {access_token: token},
//     // function(data){ document.write("Data Loaded: " + data);
        
//     // });
// }
 
    function LoginFacebook()
    {
 
        FB.login(function(response) {
           if (response.authResponse) 
           {
                FB.api('/me',{ locale: 'en_US', fields: 'friends,name, email' }, function(response) {
                     console.log(response);
                     var usuario = response.name;
                     var email = response.email;
        
                     registrarUsuarioConFacebook(usuario,email);
                    debugger;
                  });
            } else 
            {
             console.log('User cancelled login or did not fully authorize.');
            }
         },{scope: 'user_friends,email,user_photos,user_videos'});
 
    }
 
//   function getUserInfo(accessToken) {
//         FB.api('/me',{ locale: 'en_US', fields: 'friends,name, email' }, function(response) {
//              console.log(response);
//       var str="<b>Name</b> : "+response.name+"<br>";
//           str +="<b>Link: </b>"+response.link+"<br>";
//           str +="<b>Username:</b> "+response.username+"<br>";
//           str +="<b>id: </b>"+response.id+"<br>";
//           str +="<b>Email:</b> "+response.email+"<br>";
//           str +="<input type='button' value='Get Photo' onclick='getPhoto();'/>";
//           str +="<input type='button' value='Logout' onclick='Logout();'/>";
//           document.getElementById("status").innerHTML=str;
 
 
 
//     });
    
   
//     }
    // function getPhoto()
    // {
    //   FB.api('/me/picture?type=normal', function(response) {
 
    //       var str="<br/><b>Pic</b> : <img src='"+response.data.url+"'/>";
    //       document.getElementById("status").innerHTML+=str;
 
    // });
 
    // }
    function LogoutFacebook()
    {
        FB.logout(function(){document.location.reload();});
    }
 
  // Load the SDK asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
    // js.src =   "//connect.facebook.net/en_US/sdk.js";
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
 