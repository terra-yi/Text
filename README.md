# Text

## Introduction
 For a strict 80 char width person, whenver I need to set text message for error, exception or others I have often experienced that it is really hard to put it in within width limit. I am not a believer in string concanation either. So here comes a simple solution I came up with recently.

## Example

### Code
```
echo Text::start()
    ->It
    ->is
    ->a
    ->wonderful
    ->text
    ->fullstop()
    ->fullstop(2)
    ->backspace()
    ->raw('more', 'text', '&', 'text', 'in', 'raw')
    ->comma()
    ->questionmark(3)
    ->newline()
    ->space()
    ->space()
    ->leftparenthesis()
    ->eol()
    ->fullstop(3)
    ->am
    ->I
    ->dreaming
    ->linebreak()
    ->or
    ->something
    ->fullstop(3)
    ->rightparenthesis()
    ,
    "\n";
```

### Output
```
It is a wonderful text.. more text & text in raw,???
  (
... am I dreaming
 or something...)
```
