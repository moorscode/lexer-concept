<?php

namespace Moorscode\Lexer;

interface LexerInterface {
	/**
	 * @param array $source
	 *
	 * @return array
	 */
	public function run( $source );
}