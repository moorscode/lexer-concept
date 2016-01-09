<?php

namespace Moorscode\Lexer;

spl_autoload_register(
	function ( $class ) {
		require str_replace( '\\', '/', $class ) . '.php';
	}
);

$input = array(
	'root -> Foo::bar',
	'map /login -> Sessions::add',
	'root -> Foo::foo',
);

$interpeter = new Interpeter();

runLexer( $input, new Lexer(), $interpeter );

function runLexer( $input, LexerInterface $lexer, InterpeterInterface $interpeter ) {
	try {
		$results = $lexer->run( $input );
	} catch ( \Exception $exception ) {
		return false;
	}

	$batch = $interpeter->begin();
	foreach ( $results as $result ) {
		$interpeter->parse( $result, $batch );
	}
	$interpeter->end( $batch );

}
