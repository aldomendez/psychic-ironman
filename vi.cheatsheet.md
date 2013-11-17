Modes
=====

Vi has two modes, insertion mode and command mode. The editor begins in command
mode, where the cursor movement and text deletion occur. Insertion mode begins upon entering an insertion or change command. [ESC], returns the editor to command mode (where you can quit, for example by typing :q!). Most commands execute as soon as you type them except for "colon" commands which execute when you press the return key.

## Quitting

| Command| Effect|
|--------|-------|
| :x     | Exit, saving changes
| :q     | Exit as long as there have been no changes
| ZZ     | Exit and save changes if any changes have been made
| :q!    | Exit and ignore any changes

## Inserting Text

| Command| Effect|
|--------|-------|
| i      | Insert before cursor
| I      | Insert before line
| a      | Append after cursor
| A      | Append after line
| o      | Open a new line after current line
| O      | Open a new line before current line
| r      | Replace one character
| R      | Replace many caracters

## Motion

| Command| Effect|
|--------| ------|
| h      | Move left
| j      | Mode down
| k      | Move Up
| l      | Move right
| w      | Move to next word
| W      | Move to next blank delimited word
| b      | Move to the beginning of the word
| B      | Move to the beginning of a blank delimited word
| e      | Move to the end of the word
| E      | Move to the end of a blank delimited word
| (      | Move to a sentense back
| )      | Move to a sentense forward
| {      | Move to a paragraph back
| }      | Move to a paragraph forward
| 0      | Move to de beginning of the line
| $      | Move to the end of the line
| 1G     | Move to the first line of the file
| G      | Move to the last line of the file
| `n`G   | Move to the `nht` line of the file
| :`n`   | Move to the `nth` line of the file
| f`c`   | Move forward to `c`
| F`c`   | Move back to `c`
| H      | Move to top of screen
| M      | Move to middle of screen
| L      | Move to bottom of screen
| %      | Move to associated (),{},[]

## Deleting text

Almost all deletion commands are performed by typing d followed by a motion. For
example, `dw` deletes a word. A few other deletes are:

| Command| Effect|
|--------|-------|
| x      | Delete character to the right of the cursor
| X      | Delete character to the left of cursor
| D      | Delete to the end of the line
| dd     | Delete current line
| :d     | Delete current line

## Yanking Text


