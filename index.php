<?php

namespace Moorscode\Lexer;

use Moorscode\RootListener;

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

$listener = new RootListener();

$observer = new Observer();
$observer->addListener( $listener, 'a5d3be5befe160765fb3ad4bbe4fbbf0' );

runLexer( $input, new Lexer(), $observer );

function runLexer( $input, Lexer $lexer, Observer $observer ) {
	$results = $lexer->run( $input );

	foreach ( $results as $result ) {
		$observer->handle( $result );
	}
}
