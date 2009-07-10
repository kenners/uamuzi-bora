
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
1	admin	82bf611c53901f13c54e59f032a4d4714168c505075f7010d05ff2d8062a8c9e	1		2009-07-10 21:35:38	2009-07-10 21:35:38
2	user	89ef4f9d082dad635f13d9aab392a2ce41f47dbfd28d783e023ccfd5213a1a67	2		2009-07-10 21:35:59	2009-07-10 21:35:59
\.
