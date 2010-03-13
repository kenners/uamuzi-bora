	
CREATE TABLE result_values(
	id serial PRIMARY KEY ,

	result_id integer NOT NULL,
	value_decimal double precision DEFAULT NULL,
	value_text character varying DEFAULT NULL,
	value_lookup integer DEFAULT NULL,
	user_id integer NOT NULL,
	created timestamp NOT NULL,
	modified timestamp NOT NULL -- check type
);

