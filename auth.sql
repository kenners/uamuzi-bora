
--
-- Data for Name: aros; Type: TABLE DATA; Schema: public; Owner: -
--

COPY aros (id, parent_id, model, foreign_key, alias, lft, rght) FROM stdin;
1	\N	Group	1	\N	1	4
3	1	User	1	\N	2	3
2	\N	Group	2	\N	5	8
4	2	User	2	\N	6	7
\.




--
-- Data for Name: groups; Type: TABLE DATA; Schema: public; Owner: -
--

COPY groups (id, name, description, created, modified) FROM stdin;
1	admin		2009-07-10 21:35:23	2009-07-10 21:35:23
2	user		2009-07-10 21:35:27	2009-07-10 21:35:27
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: -
--

COPY users (id, username, password, group_id, name, created, modified) FROM stdin;
1	admin	aa50ebeb6ecacbc15ef22ca164b7342db76e725bfefcc1d01086d0dcc343e247	1		2009-07-10 21:35:38	2009-07-10 21:35:38
2	user	fbcc1b48abce87fff7c6c18821157c00f80ce2707d7859daaf49efb4a2bbf218	2		2009-07-10 21:35:59	2009-07-10 21:35:59
\.
