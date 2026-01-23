
'use strict';

const process = require( 'process' );

const colors = [
	'primary',
	'secondary',
	'light',
	'black',
	'white',
	'gray',
	'gray-dark',
	'gray-light',
	'dark-blue',
	'purple',
	'cyan',
	'pink',
	'pale-pink',
	'dark-coral',
	'red',
	'camel',
	'green',
	'sea-green',
	'amber',
	'brown'
];

module.exports = ( ctx ) => {
	return {
		map: {
			inline: false,
			annotation: true,
			sourcesContent: true,
		},
		plugins: {
			autoprefixer: {
				cascade: false,
				env: 'bs5',
			},
			'postcss-understrap-palette-generator': {
				colors: colors.map( ( x ) => `--${ 'bs-' }${ x }` ),
			},
		},
	};
};
