## Testing

Run `phpunit tests` from the docroot

I ran into this when I first tried:

```
PHP Warning:  require_once(src/User.php): failed to open stream: No such file or directory in /Users/brian.kropff/Sites/php/myPCs/tests/UserTest.php on line 8
```

The `src/User.php` did not exist as I was using `src/Player.php`.

Then I ran into this:

```
PHP Parse error:  syntax error, unexpected end of file, expecting function (T_FUNCTION) in /Users/brian.kropff/Sites/php/myPCs/src/Player.php on line 41
```

...because i forgot this `}?>` at the end of the `Player.php` file.


Then a couple more edits that would not have happened if I had build this completely from scratch :-|

But, now it tests!

** Final Testing note **

Comment out any database information while you are building without the DB.

Of course, be sure to uncomment it once you are ready to bring it back.
