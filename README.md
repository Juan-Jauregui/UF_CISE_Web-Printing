# UF CISE Web Printing
A web tool to allow remotely printing to the CISE network's printers.

## Usage
1. Follow [the department's instructions](https://www.cise.ufl.edu/help/web/php) on running PHP programs using the hosting  provided to you.
2. Place `print.php`, `do_print.php` in `~/public_html/`, and the folder `phpseclib1.0.5` inside of `~/public_html/lib/` 
  * Make sure you give all files and folders the appropriate permissions as detailed in the above instructions

## How it works
Once set up, you'll be able to access the page `www.cise.ufl.edu/~your_cise_username_here/print.php`.

You'll need your CISE username and password (see _Disclaimers_) so that your personal print quota is used.

You'll also need to specify which printer to print to: ps114 (in the dungeon) and ps309 (in room 309) are supported by default, but if you want to print to other printers it should be easy to add another entry yourself.

You can then upload your file and specify how many copies to print.

Pressing 'submit' uploads your file and lets `do_print.php` handle the rest of the process.

`do_print.php` handles the file upload by creating a temporary directory, moving the uploaded file into it, and printing the specified number of copies to the specified printer using `lp`. It does this by using the provided CISE account credentials to execute the `lp` command through SSH (provided by `phpseclib`). The output from `lp` will be returned as confirmation.

## Disclaimers
### Security and Privacy
>..."The university employs various measures to protect the security of its IT resources and user accounts. However the university cannot guarantee complete security and confidentiality. **It is the responsibility of users to practice “safe computing” by establishing appropriate access restrictions for their accounts, by guarding their passwords, and by changing them regularly."**

**Only use this tool if you have set it up yourself. Do not use versions hosted on other students' accounts.**
While this tool uses an open-source SSH library and you can read the the source for `do_print.php` to see that nothing weird is being done with your credentials, _you can never be sure that others are running an unmodified version of this tool_. They could easily be logging your CISE account credentials and you would never know.

### Other disclaimers
  * This tool does nothing you can't already do using `scp`/ftp and `ssh`. It just makes it simpler to upload and print your documents in one place
  * Printing is limited to the capabilities provided by `lp`.
  * Since you are logging in through SSH to print, you are still restricted to your account's monthly printing limits.

## Contributing
If you think this tool lacks a specific functionality that you would like to see, feel free to fork the project and implement it yourself. I wrote it with just my own needs in mind, so it's pretty basic. It's licensed under GPLv3 so you can basically do whatever.
