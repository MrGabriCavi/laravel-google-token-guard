# Laravel Google Token Guard

## Introduction
**The package purpose is to use the Google&trade; token for authentication on API backend without managing any information about session or login.**

Starting from the original Google&trade; guide [Authenticate with a backend server](https://developers.google.com/identity/sign-in/web/backend-auth?hl=en) that assume any kind of session that could you open server side after validating the Google&trade; token ID, this package allows to save users in your system with hashed information in database and associate to the original token. 
Since the token ID contains the user ID on Google&trade; systems and [Google&trade; guide itself suggest to use this ID to associate any information to the user]( https://developers.google.com/identity/sign-in/web/backend-auth?hl=en#create-an-account-or-session)
after a first POST request with original token and the token ID, you could make all call to guard api protected only with token in Authorization header in Bearer mode. 
