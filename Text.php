<?php

/**
 * Text
 *
 * @category Class
 * @package  Text
 * @author   terrayi
 * @license  https://opensource.org/licenses/MIT MIT License
 */
class Text
{
    /** @var array */
    protected $specialCharacters = [
        'ampersand' => '&',
        'asterisk' => '*',
        'at' => '@',
        'backtick' => '`',
        'backslash' => '\\',
        'caret' => '^',
        'colon' => ':',
        'comma' => ',',
        'dollar' => '$',
        'doublequote' => '"',
		'eol' => "\n",
        'equal' => '=',
        'exclamationmark' => '!',
        'fullstop' => '.',
        'greaterthan' => '>',
        'hash' => '#',
        'leftbrace' => '{',
        'leftbracket' => '[',
        'leftparenthesis' => '(',
        'lessthan' => '<',
		'linebreak' => "\n",
        'minus' => '-',
		'newline' => "\n",
        'percentage' => '%',
        'plus' => '+',
        'questionmark' => '?',
        'quote' => "'",
        'rightbrace' => '}',
        'rightbracket' => ']',
        'rightparenthesis' => ')',
        'semicolon' => ';',
        'slash' => '/',
        'space' => ' ',
        'tilde' => '~',
        'underscore' => '_',
        'verticalbar' => '|'
    ];

    /** @var string */
    protected $string = '';

    /**
     * constructor
     *
     * @param  string  $text
     * @param  string  $previous
     * @return Text
     */
    public function __construct(string $text = '', string $previous = '')
    {
        $this->string = $previous . $text;

        if (!$previous) {
            $this->string = trim($this->string);
        }
    }

    /**
     * __call
     *
     * @param  string  $name
     * @param  array  $arguments
     * @return Text
     */
    public function __call(string $name, array $arguments)
    {
        $nextText = '';
        $hasArgument = (count($arguments) > 0);
        $firstArgument = ($hasArgument ? $arguments[0] : null);
        $numericArgument = ($hasArgument && is_numeric($firstArgument));

        if ($name === 'backspace') {
            $len = strlen($this->string);
            $count = ($numericArgument ? $firstArgument : 1);

            if ($len >= $count) {
                $nextText = substr($this->string, 0, -$count);
                return new self($nextText);
            }

            return $this;
        }

        if (array_key_exists($name, $this->specialCharacters)) {
            $nextText = $this->specialCharacters[$name];

            if ($numericArgument) {
                $nextText = str_repeat($nextText, $firstArgument);
            }
        } elseif ($name === 'raw' && $hasArgument) {
            $nextText = ' ' . implode(' ', $arguments);
        } else {
            throw new \Exception('unknown command: ' . $name);
        }

        return new self($nextText, $this->string);
    }

    /**
     * __get
     *
     * @param  string  $name
     * @return Text
     */
    public function __get(string $name)
    {
        return new self(" {$name}", $this->string);
    }

    /**
     * __toString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->string;
    }

    /**
     * start
     *
     * @return Text
     */
    public static function start()
    {
        return new self;
    }
}

/*
// example
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
*/
