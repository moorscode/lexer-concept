<?php

namespace Moorscode;

use Moorscode\Lexer\ListenerInterface;
use Moorscode\Lexer\Result;

/**
 * Class RootListener
 */
class RootListener implements ListenerInterface {

	/**
	 * @param Result $result
	 *
	 * @return void
	 */
	public function handle( Result $result ) {
		echo 'Listener got called: ';
		var_export( $result->get() );
	}
}
