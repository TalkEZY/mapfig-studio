--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: membership; Type: TABLE; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

CREATE TABLE membership (
    id integer NOT NULL,
    name character varying(255),
    active boolean DEFAULT true NOT NULL,
    allow_projects numeric(32,0) DEFAULT 0 NOT NULL,
    allow_users numeric(32,0) DEFAULT 0 NOT NULL,
    allow_datatable numeric(32,0) DEFAULT 0 NOT NULL,
    allow_apikey numeric(32,0) DEFAULT 0 NOT NULL,
	allow_apicalls numeric(32,0) DEFAULT 0 NOT NULL,
    allow_playback numeric(32,0) DEFAULT 0 NOT NULL,
    allow_svg numeric(32,0) DEFAULT 0 NOT NULL,
    allow_datatable_rows numeric(32,0) DEFAULT 0 NOT NULL,
	allow_statistics_download boolean DEFAULT false NOT NULL
);


ALTER TABLE membership OWNER TO [#OWNER#];

--
-- Name: membership_id_seq; Type: SEQUENCE; Schema: public; Owner: [#OWNER#]
--

CREATE SEQUENCE membership_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE membership_id_seq OWNER TO [#OWNER#];

--
-- Name: membership_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: [#OWNER#]
--

ALTER SEQUENCE membership_id_seq OWNED BY membership.id;



--
-- Name: admin; Type: TABLE; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

CREATE TABLE admin (
    id integer NOT NULL,
    firstname character(255),
    lastname character(255),
    email character varying,
    password character(32),
    level numeric(1,0) DEFAULT 5
);


ALTER TABLE admin OWNER TO [#OWNER#];

--
-- Name: COLUMN admin.level; Type: COMMENT; Schema: public; Owner: [#OWNER#]
--

COMMENT ON COLUMN admin.level IS '5 = Admin';


--
-- Name: admin_id_seq; Type: SEQUENCE; Schema: public; Owner: [#OWNER#]
--

CREATE SEQUENCE admin_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE admin_id_seq OWNER TO [#OWNER#];

--
-- Name: admin_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: [#OWNER#]
--

ALTER SEQUENCE admin_id_seq OWNED BY admin.id;


--
-- Name: groups; Type: TABLE; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

CREATE TABLE groups (
    id integer NOT NULL,
    users_id numeric NOT NULL,
    name character varying(100) NOT NULL
);


ALTER TABLE groups OWNER TO [#OWNER#];

--
-- Name: groups_has_layers; Type: TABLE; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

CREATE TABLE groups_has_layers (
    id integer NOT NULL,
    groups_id numeric NOT NULL,
    layers_id numeric NOT NULL
);


ALTER TABLE groups_has_layers OWNER TO [#OWNER#];

--
-- Name: groups_has_layers_id_seq; Type: SEQUENCE; Schema: public; Owner: [#OWNER#]
--

CREATE SEQUENCE groups_has_layers_id_seq
    START WITH 100
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE groups_has_layers_id_seq OWNER TO [#OWNER#];

--
-- Name: groups_has_layers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: [#OWNER#]
--

ALTER SEQUENCE groups_has_layers_id_seq OWNED BY groups_has_layers.id;


--
-- Name: groups_id_seq; Type: SEQUENCE; Schema: public; Owner: [#OWNER#]
--

CREATE SEQUENCE groups_id_seq
    START WITH 100
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE groups_id_seq OWNER TO [#OWNER#];

--
-- Name: groups_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: [#OWNER#]
--

ALTER SEQUENCE groups_id_seq OWNED BY groups.id;


--
-- Name: layers; Type: TABLE; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

CREATE TABLE layers (
    id integer NOT NULL,
    users_id numeric NOT NULL,
    url character varying(500) NOT NULL,
    lkey character varying(100) NOT NULL,
    accesstoken character varying DEFAULT ''::character varying,
    name character varying(100) NOT NULL,
    attribution character varying DEFAULT ''::character varying
);


ALTER TABLE layers OWNER TO [#OWNER#];

--
-- Name: layers_id_seq; Type: SEQUENCE; Schema: public; Owner: [#OWNER#]
--

CREATE SEQUENCE layers_id_seq
    START WITH 100
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE layers_id_seq OWNER TO [#OWNER#];

--
-- Name: layers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: [#OWNER#]
--

ALTER SEQUENCE layers_id_seq OWNED BY layers.id;


SET default_with_oids = true;

--
-- Name: maps; Type: TABLE; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

CREATE TABLE maps (
    id integer NOT NULL,
    users_id integer NOT NULL,
    height integer DEFAULT 500,
    width integer DEFAULT 500,
    zoom integer DEFAULT 8,
    showsidebar boolean DEFAULT true,
    defaultopen boolean DEFAULT false,
    status boolean DEFAULT true NOT NULL,
    createdon integer NOT NULL,
    name character varying(200) NOT NULL,
    layers_id numeric DEFAULT 1 NOT NULL,
    groups_id numeric DEFAULT 0 NOT NULL,
    setgrouptoopen boolean DEFAULT false,
    button_style character varying(15) DEFAULT 'default'::character varying NOT NULL,
    mapcenter character varying DEFAULT '[0,0]'::character varying NOT NULL,
    password character varying DEFAULT ''::character varying,
    filteredcolumns character varying DEFAULT '[]'::character varying,
    stylingcolumn character varying DEFAULT '[]'::character varying,
    shapestyling character varying DEFAULT '[]'::character varying,
    cluster boolean DEFAULT true,
    overlay_title character varying DEFAULT ''::character varying,
    overlay_content character varying DEFAULT ''::character varying,
    overlay_blurb character varying DEFAULT ''::character varying,
    overlay_enable boolean DEFAULT false,
    legend_content character varying DEFAULT ''::character varying,
    legend_enable boolean DEFAULT false,
    image_overlays character varying DEFAULT '[]'::character varying,
    show_export boolean DEFAULT false,
    projects_id numeric DEFAULT 0,
    show_measure boolean DEFAULT true,
    show_minimap boolean DEFAULT true,
    show_search boolean DEFAULT true,
    show_filelayer boolean DEFAULT false,
    show_playback boolean DEFAULT false,
    gpx_tracks character varying DEFAULT '[]'::character varying,
	show_static_sidebar boolean DEFAULT false,
    static_sidebar_content character varying DEFAULT ''::character varying,
	show_svg boolean DEFAULT false,
	source character varying DEFAULT 'api'::character varying,
	map_views numeric(32,0) DEFAULT 0 NOT NULL,
	map_bounds character varying DEFAULT '[]'::character varying
);


ALTER TABLE maps OWNER TO [#OWNER#];

--
-- Name: COLUMN maps.stylingcolumn; Type: COMMENT; Schema: public; Owner: [#OWNER#]
--

COMMENT ON COLUMN maps.stylingcolumn IS 'Used to store column name, the styling applied on';


--
-- Name: COLUMN maps.shapestyling; Type: COMMENT; Schema: public; Owner: [#OWNER#]
--

COMMENT ON COLUMN maps.shapestyling IS 'Shape Styling in JSON form';


--
-- Name: maps_id_seq; Type: SEQUENCE; Schema: public; Owner: [#OWNER#]
--

CREATE SEQUENCE maps_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE maps_id_seq OWNER TO [#OWNER#];

--
-- Name: maps_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: [#OWNER#]
--

ALTER SEQUENCE maps_id_seq OWNED BY maps.id;


SET default_with_oids = false;

--
-- Name: project_has_users; Type: TABLE; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

CREATE TABLE project_has_users (
    id integer NOT NULL,
    projects_id numeric,
    users_id numeric
);


ALTER TABLE project_has_users OWNER TO [#OWNER#];

--
-- Name: project_has_users_id_seq; Type: SEQUENCE; Schema: public; Owner: [#OWNER#]
--

CREATE SEQUENCE project_has_users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE project_has_users_id_seq OWNER TO [#OWNER#];

--
-- Name: project_has_users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: [#OWNER#]
--

ALTER SEQUENCE project_has_users_id_seq OWNED BY project_has_users.id;


--
-- Name: projects; Type: TABLE; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

CREATE TABLE projects (
    id integer NOT NULL,
    users_id numeric DEFAULT 0,
    name character varying
);


ALTER TABLE projects OWNER TO [#OWNER#];

--
-- Name: projects_id_seq; Type: SEQUENCE; Schema: public; Owner: [#OWNER#]
--

CREATE SEQUENCE projects_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE projects_id_seq OWNER TO [#OWNER#];

--
-- Name: projects_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: [#OWNER#]
--

ALTER SEQUENCE projects_id_seq OWNED BY projects.id;


SET default_with_oids = true;

--
-- Name: shapes; Type: TABLE; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

CREATE TABLE shapes (
    id integer NOT NULL,
    type character varying(20) NOT NULL,
    coordinates character varying NOT NULL,
    maps_id numeric NOT NULL,
    properties character varying DEFAULT '[]'::character varying NOT NULL,
    style character varying DEFAULT '{}'::character varying NOT NULL,
    customproperties character varying DEFAULT '{}'::character varying NOT NULL
);


ALTER TABLE shapes OWNER TO [#OWNER#];

--
-- Name: shapes_id_seq; Type: SEQUENCE; Schema: public; Owner: [#OWNER#]
--

CREATE SEQUENCE shapes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE shapes_id_seq OWNER TO [#OWNER#];

--
-- Name: shapes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: [#OWNER#]
--

ALTER SEQUENCE shapes_id_seq OWNED BY shapes.id;

--
-- Name: users; Type: TABLE; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

CREATE TABLE users (
    id integer NOT NULL,
    firstname character varying(255) NOT NULL,
    lastname character varying(255) NOT NULL,
    email character varying(500) NOT NULL,
    password character varying(32) NOT NULL,
    apikey character varying(32) NOT NULL,
    users_id numeric DEFAULT 0,
    activationkey character varying DEFAULT ''::character varying,
    membership_id numeric DEFAULT 1,
	apicalls numeric(32,0) DEFAULT 0 NOT NULL,
	cdn_url character varying(200) DEFAULT '' NOT NULL
);


ALTER TABLE users OWNER TO [#OWNER#];

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: [#OWNER#]
--

CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE users_id_seq OWNER TO [#OWNER#];

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: [#OWNER#]
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: [#OWNER#]
--

ALTER TABLE ONLY membership ALTER COLUMN id SET DEFAULT nextval('membership_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: [#OWNER#]
--

ALTER TABLE ONLY admin ALTER COLUMN id SET DEFAULT nextval('admin_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: [#OWNER#]
--

ALTER TABLE ONLY groups ALTER COLUMN id SET DEFAULT nextval('groups_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: [#OWNER#]
--

ALTER TABLE ONLY groups_has_layers ALTER COLUMN id SET DEFAULT nextval('groups_has_layers_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: [#OWNER#]
--

ALTER TABLE ONLY layers ALTER COLUMN id SET DEFAULT nextval('layers_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: [#OWNER#]
--

ALTER TABLE ONLY maps ALTER COLUMN id SET DEFAULT nextval('maps_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: [#OWNER#]
--

ALTER TABLE ONLY project_has_users ALTER COLUMN id SET DEFAULT nextval('project_has_users_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: [#OWNER#]
--

ALTER TABLE ONLY projects ALTER COLUMN id SET DEFAULT nextval('projects_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: [#OWNER#]
--

ALTER TABLE ONLY shapes ALTER COLUMN id SET DEFAULT nextval('shapes_id_seq'::regclass);

--
-- Name: id; Type: DEFAULT; Schema: public; Owner: [#OWNER#]
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- Name: membership_pkey; Type: CONSTRAINT; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

ALTER TABLE ONLY membership
    ADD CONSTRAINT membership_pkey PRIMARY KEY (id);


--
-- Name: admin_pkey; Type: CONSTRAINT; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

ALTER TABLE ONLY admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (id);


--
-- Data for Name: membership; Type: TABLE DATA; Schema: public; Owner: [#OWNER#]
--

INSERT INTO membership VALUES (1, 'Free', true, 0, 0, 0, 1, 100, 0, 0, 100, false);
INSERT INTO membership VALUES (2, 'Personal', true, 1, 0, 1, 1, 500, 1, 1, 999999, true);
INSERT INTO membership VALUES (3, 'Webmaster', true, 1, 5, 1, 1, 1000, 1, 1, 999999, true);


--
-- Data for Name: groups; Type: TABLE DATA; Schema: public; Owner: [#OWNER#]
--

INSERT INTO groups VALUES (1, 0, 'Default Group');
-- INSERT INTO groups VALUES (2, [#USER_ID#], 'My Group');


--
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: [#OWNER#]
--

INSERT INTO admin VALUES (1, 'Admin', 'Admin', 'info@[#OWNER#].com', '1a1dc91c907325c69271ddf0c944bc72', '5');
INSERT INTO admin VALUES (2, 'Muaaz', 'Khalid', 'info@fastesol.com', '1a1dc91c907325c69271ddf0c944bc72', '1');


--
-- Data for Name: groups_has_layers; Type: TABLE DATA; Schema: public; Owner: [#OWNER#]
--

INSERT INTO groups_has_layers VALUES (1, 1, 1);



--
-- Name: membership_id_seq; Type: SEQUENCE SET; Schema: public; Owner: [#OWNER#]
--

SELECT pg_catalog.setval('membership_id_seq', 2, true);


--
-- Name: groups_has_layers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: [#OWNER#]
--

SELECT pg_catalog.setval('groups_has_layers_id_seq', 100, false);


--
-- Name: groups_id_seq; Type: SEQUENCE SET; Schema: public; Owner: [#OWNER#]
--

SELECT pg_catalog.setval('groups_id_seq', 100, false);


--
-- Data for Name: layers; Type: TABLE DATA; Schema: public; Owner: [#OWNER#]
--

INSERT INTO layers VALUES (1, 0, 'https://otile3-s.mqcdn.com/tiles/1.0.0/map/{z}/{x}/{y}.png', '', '', 'MapQuest', '<a href="https://openstreetmap.org" target="_blank">OpenStreetMap. </a> Tiles Courtesy of <a href="http://www.mapquest.com/" target="_blank">MapQuest</a>');


--
-- Name: layers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: [#OWNER#]
--

SELECT pg_catalog.setval('layers_id_seq', 100, false);


--
-- Data for Name: maps; Type: TABLE DATA; Schema: public; Owner: [#OWNER#]
--



--
-- Name: maps_id_seq; Type: SEQUENCE SET; Schema: public; Owner: [#OWNER#]
--

SELECT pg_catalog.setval('maps_id_seq', 1, false);


--
-- Data for Name: project_has_users; Type: TABLE DATA; Schema: public; Owner: [#OWNER#]
--



--
-- Name: project_has_users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: [#OWNER#]
--

SELECT pg_catalog.setval('project_has_users_id_seq', 1, false);


--
-- Data for Name: projects; Type: TABLE DATA; Schema: public; Owner: [#OWNER#]
--



--
-- Name: projects_id_seq; Type: SEQUENCE SET; Schema: public; Owner: [#OWNER#]
--

SELECT pg_catalog.setval('projects_id_seq', 1, false);


--
-- Data for Name: shapes; Type: TABLE DATA; Schema: public; Owner: [#OWNER#]
--



--
-- Name: shapes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: [#OWNER#]
--

SELECT pg_catalog.setval('shapes_id_seq', 1, false);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: [#OWNER#]
--



--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: [#OWNER#]
--

SELECT pg_catalog.setval('users_id_seq', 1, false);


--
-- Name: group_has_layers_pkey; Type: CONSTRAINT; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

ALTER TABLE ONLY groups_has_layers
    ADD CONSTRAINT group_has_layers_pkey PRIMARY KEY (id);


--
-- Name: group_pkey; Type: CONSTRAINT; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

ALTER TABLE ONLY groups
    ADD CONSTRAINT group_pkey PRIMARY KEY (id);


--
-- Name: layers_pkey; Type: CONSTRAINT; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

ALTER TABLE ONLY layers
    ADD CONSTRAINT layers_pkey PRIMARY KEY (id);


--
-- Name: maps_id_pk; Type: CONSTRAINT; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

ALTER TABLE ONLY maps
    ADD CONSTRAINT maps_id_pk PRIMARY KEY (id);


--
-- Name: project_has_users_pkey; Type: CONSTRAINT; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

ALTER TABLE ONLY project_has_users
    ADD CONSTRAINT project_has_users_pkey PRIMARY KEY (id);


--
-- Name: projects_pkey; Type: CONSTRAINT; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

ALTER TABLE ONLY projects
    ADD CONSTRAINT projects_pkey PRIMARY KEY (id);


--
-- Name: shapes_pkey; Type: CONSTRAINT; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

ALTER TABLE ONLY shapes
    ADD CONSTRAINT shapes_pkey PRIMARY KEY (id);

--
-- Name: users_email_key; Type: CONSTRAINT; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

-- ALTER TABLE ONLY users
--    ADD CONSTRAINT users_email_key UNIQUE (email);


	
ALTER TABLE ONLY users ADD COLUMN createdat timestamp without time zone default (now() at time zone 'utc');
ALTER TABLE ONLY membership ADD COLUMN createdat timestamp without time zone default (now() at time zone 'utc');
ALTER TABLE ONLY groups ADD COLUMN createdat timestamp without time zone default (now() at time zone 'utc');
ALTER TABLE ONLY layers ADD COLUMN createdat timestamp without time zone default (now() at time zone 'utc');
ALTER TABLE ONLY maps ADD COLUMN createdat timestamp without time zone default (now() at time zone 'utc');
ALTER TABLE ONLY projects ADD COLUMN createdat timestamp without time zone default (now() at time zone 'utc');
ALTER TABLE ONLY shapes ADD COLUMN createdat timestamp without time zone default (now() at time zone 'utc');
	

ALTER TABLE ONLY users ADD COLUMN register_type character varying(20) DEFAULT '[#OWNER#]'::character varying;
ALTER TABLE ONLY users ADD COLUMN twitter_id numeric(32) DEFAULT 0;
ALTER TABLE ONLY users ADD COLUMN facebook_id numeric(32) DEFAULT 0;

ALTER TABLE ONLY users ADD COLUMN allowed_users numeric(32) DEFAULT 0;	


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--
