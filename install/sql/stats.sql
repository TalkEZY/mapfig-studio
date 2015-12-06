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
-- Name: statistics_maps_view; Type: TABLE; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

CREATE TABLE statistics_maps_view (
    id integer NOT NULL,
    viewed_at timestamp without time zone default (now() at time zone 'utc'),
    maps_id numeric(32,0) NOT NULL,
	maps_name character varying NOT NULL,
	apikey character varying NOT NULL,
	ip character varying(25) NOT NULL,
	hostname character varying DEFAULT ''::character varying,
	city character varying DEFAULT ''::character varying,
	region character varying DEFAULT ''::character varying,
	country character varying DEFAULT ''::character varying,
	loc character varying DEFAULT '0,0'::character varying,
	org character varying DEFAULT ''::character varying,
	postal character varying DEFAULT ''::character varying,
	phone character varying DEFAULT ''::character varying,
	referer_url character varying DEFAULT ''::character varying,
	browser_name character varying DEFAULT ''::character varying,
	browser_version character varying DEFAULT ''::character varying,
	os character varying DEFAULT ''::character varying
);


ALTER TABLE statistics_maps_view OWNER TO [#OWNER#];

--
-- Name: statistics_maps_view_id_seq; Type: SEQUENCE; Schema: public; Owner: [#OWNER#]
--

CREATE SEQUENCE statistics_maps_view_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE statistics_maps_view_id_seq OWNER TO [#OWNER#];


--
-- Name: statistics_maps_view_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: [#OWNER#]
--

ALTER SEQUENCE statistics_maps_view_id_seq OWNED BY statistics_maps_view.id;

--
-- Name: id; Type: DEFAULT; Schema: public; Owner: [#OWNER#]
--

ALTER TABLE ONLY statistics_maps_view ALTER COLUMN id SET DEFAULT nextval('statistics_maps_view_id_seq'::regclass);

--
-- Name: statistics_maps_view_pkey; Type: CONSTRAINT; Schema: public; Owner: [#OWNER#]; Tablespace: 
--

ALTER TABLE ONLY statistics_maps_view
    ADD CONSTRAINT statistics_maps_view_pkey PRIMARY KEY (id);

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