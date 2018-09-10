-- MySQL dump 10.13  Distrib 5.5.58, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: trademux
-- ------------------------------------------------------
-- Server version	5.5.58-0+deb7u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) DEFAULT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `alias` varchar(1000) DEFAULT NULL,
  `preview` text,
  `content` longtext,
  `create_date` datetime DEFAULT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_title` varchar(1000) DEFAULT NULL,
  `meta_keywords` varchar(2000) DEFAULT NULL,
  `meta_description` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `i_cat_id` (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (18,7,'Contact Us','contact_us','','<div class=\"one-three first\">\r\n	<div id=\"rt-sidebar-a\">\r\n		<div class=\"rt-sidebar-inner\">\r\n			<p style=\"margin-top: -25px; padding-top: 30px;\">\r\n				<strong>Sales Department</strong><br />\r\n				Skype: trademux.platform<br />\r\n				Phone: +507 836 7998<br />\r\n				E mail: sales@trademux.net</p>\r\n			<p style=\"padding-bottom:150px\">\r\n				<strong>Support Department</strong><br />\r\n				E-mail: suport@trademux.net</p>\r\n		</div>\r\n	</div>\r\n</div>\r\n<div class=\"two-three last\">\r\n	<h2>\r\n		Have a question? Need an answer?</h2>\r\n	<div id=\"feedbackformblock\" type=\"contactus\">\r\n		<img alt=\"Loading ...\" src=\"/images/ajax-loader.gif\" /></div>\r\n</div>\r\n<div class=\"clear\">\r\n	&nbsp;</div>\r\n','2011-02-01 15:48:37','2015-08-12 17:30:50','Contact information','Contact information','TradeMUX contact information'),(61,10,'Trading server for FOREX and CFDs trading','trading_server_forex_cfds','','<img alt=\"High performance trading server\" class=\"image-left image-middle\" src=\"/uploads/images/high_performance_trading_server.png\" />\r\n<div style=\"margin-left: 505px\">\r\n	<h3>\r\n		<span style=\"font-size:14px;\"><strong>TradeMUX FOREX and CFDs trading server</strong></span></h3>\r\n	<p>\r\n		<span style=\"font-size:14px;\"><strong>TradeMUX Trading Server</strong> is a low latency trading server for FOREX and CFDs trading. It consists of bridges to liquidity providers, smart order routing engine, order matching engine (OMS), ticker plants, execution management server (EMS), history database and reporting server.</span></p>\r\n	<ul class=\"list-arrowright\">\r\n		<li>\r\n			<span style=\"font-size:14px;\">Our ticker plant can process 250,000 quotes per second.</span></li>\r\n		<li>\r\n			<span style=\"font-size:14px;\">Our historical server can transfer up to 4 million historical ticks per second.</span></li>\r\n		<li>\r\n			<span style=\"font-size:14px;\">Our order routing engine can process the trade in 30-150 microseconds.</span></li>\r\n		<li>\r\n			<span style=\"font-size:14px;\">Plug-in capable architecture gives limitless opportunities for platform extensions.</span></li>\r\n	</ul>\r\n	<br />\r\n	<p>\r\n		<span style=\"font-size:14px;\">Website, CRMs, Payments systems and custom applications can be integrated with TradeMUX trading server via TMX API. Integration with liquidity providers can be done via FIX or any custom protocols.</span></p>\r\n</div>\r\n<div class=\"clear\">\r\n	&nbsp;</div>\r\n','2015-02-18 17:12:26','2015-05-18 15:24:51','forex and cfds trading server, ems, oms and matching engine','forex trading server, forex oms, forex ems, forex history server, forex quotes server, forex order routing engine, forex matching engine','FOREX and CFDs trading server consisting of bridges to liquidity providers, smart order routing engine, order matching engine and execution management server.'),(63,9,'Customizable workplace','customizable_workplace','<div class=\"one-two first\">\r\n  <img class=\"image-center image-big\" src=\"/uploads/images/cat_workplace.png\" />\r\n</div>\r\n<div class=\"one-two last\">\r\n  <ul class=\"list-arrowright\">\r\n    <li>Functionality divided by 20 panels</li>\r\n    <li>Multiple screen support</li>\r\n    <li>Detached mode</li>\r\n    <li>Resize panels</li>\r\n    <li>Hide panels</li>\r\n    <li>Organize panels in tabs</li>\r\n  </ul>\r\n</div>','<div class=\"one-two first\">\r\n	<div class=\"avPlayerWrapper\">\r\n		<div class=\"avPlayerContainer\" style=\"width:434px;\">\r\n			<div class=\"avPlayerBlock\">\r\n				<iframe frameborder=\"0\" height=\"250\" src=\"http://player.vimeo.com/video/123497647?portrait=0\" title=\"customizable forex and cfds trading platform\" width=\"434\"></iframe></div>\r\n		</div>\r\n	</div>\r\n</div>\r\n<div class=\"one-two last\">\r\n	<span style=\"font-size:14px;\">You can easily customize the trading workplace for your needs. The functionality of the trading platform is divided into multiple panels. Simply change the size and position of the panels, detach them and move to another screen, attach one panel to another and create a workplace that 100% meets your needs.</span></div>\r\n<div class=\"clear\">\r\n	&nbsp;</div>\r\n<br />\r\n<div>\r\n	<h3>\r\n		TradeMUX FOREX and CFDs trading platform screenshots</h3>\r\n	<div class=\"gallery-box\">\r\n		<div class=\"sigplus-gallery sigplus-left sigplus-clear\" id=\"galleryformblock\">\r\n			<ul>\r\n				<li>\r\n					<a href=\"/uploads/images/workspace/1.png\"><img alt=\"forex trading platform\" height=\"90\" src=\"/uploads/images/workspace/preview/1.png\" width=\"196\" /></a></li>\r\n				<li>\r\n					<a href=\"/uploads/images/workspace/2.png\"><img alt=\"cfds trading platform\" height=\"90\" src=\"/uploads/images/workspace/preview/2.png\" width=\"196\" /></a></li>\r\n				<li>\r\n					<a href=\"/uploads/images/workspace/3.png\"><img alt=\"customizable trading platform\" height=\"90\" src=\"/uploads/images/workspace/preview/3.png\" width=\"196\" /></a></li>\r\n				<li>\r\n					<a href=\"/uploads/images/workspace/4.png\"><img alt=\"forex brokerage software\" height=\"90\" src=\"/uploads/images/workspace/preview/4.png\" width=\"196\" /></a></li>\r\n				<li>\r\n					<a href=\"/uploads/images/workspace/5.png\"><img alt=\"cfds brokerage software\" height=\"90\" src=\"/uploads/images/workspace/preview/5.png\" width=\"196\" /></a></li>\r\n				<li>\r\n					<a href=\"/uploads/images/workspace/6.png\"><img alt=\"forex brokerage solution\" height=\"90\" src=\"/uploads/images/workspace/preview/6.png\" width=\"196\" /></a></li>\r\n				<li>\r\n					<a href=\"/uploads/images/workspace/7.png\"><img alt=\"cfds brokerage solution\" height=\"90\" src=\"/uploads/images/workspace/preview/7.png\" width=\"196\" /></a></li>\r\n				<li>\r\n					<a href=\"/uploads/images/workspace/8.png\"><img alt=\"customizable brokerage software\" height=\"90\" src=\"/uploads/images/workspace/preview/8.png\" width=\"196\" /></a></li>\r\n			</ul>\r\n		</div>\r\n	</div>\r\n	<div class=\"clear\">\r\n		&nbsp;</div>\r\n</div>\r\n','2015-02-18 17:14:24','2015-05-18 16:34:09','Trading Platform Customizable Workplace','trading platform, trading platform workplace, trading platform customizable, forex trading platform, fx trading platform, cfds trading platform','TradeMUX - customizable forex and cfds trading platform and brokerage software.'),(64,9,'Trading Functionality - perfectly suited for Scalping and News traders','trading_functionality','<div class=\"one-two first\">\r\n  <img class=\"image-center image-big\" src=\"/uploads/images/cat_trading.png\" />\r\n</div>\r\n<div class=\"one-two last\">\r\n  <ul class=\"list-arrowright\">\r\n    <li>Multiple Liquidity Providers</li>\r\n    <li>One click trading</li>\r\n    <li>Bulk order management</li>\r\n    <li>Basket orders</li>\r\n    <li>Trading from charts</li>\r\n    <li>Algo trading and MQL4 support</li>\r\n    <li>Multi accounts management</li>\r\n    <li>Low latency execution</li>\r\n    <li>Microsecond timestamp for HFT traders</li>\r\n  </ul>\r\n</div>','<div class=\"one-two first\">\r\n	<div class=\"avPlayerWrapper\">\r\n		<div class=\"avPlayerContainer\" style=\"width:434px;\">\r\n			<div class=\"avPlayerBlock\">\r\n				<iframe frameborder=\"0\" height=\"250\" src=\"http://player.vimeo.com/video/123442197?portrait=0\" title=\"Low latecny FOREX and CFDs trading\" width=\"434\"></iframe></div>\r\n		</div>\r\n	</div>\r\n</div>\r\n<div class=\"one-two last\">\r\n	<p>\r\n		&nbsp;</p>\r\n	<h3>\r\n		Ultra low-latecny trading platform for FOREX and CFDs trading. Microseconds execution speed.</h3>\r\n	<span style=\"line-height: 1.7em;\">Your scalping, news and HFT strategies will be trade much more profitably. Orders are processed and sent to liquidity providers in 30 to 150 microseconds. That means less slippage, higher fill ratios, better prices and more profitable trading as a result.&nbsp;</span>\r\n	<p>\r\n		&nbsp;</p>\r\n	<div>\r\n		<h3>\r\n			<span style=\"font-size:14px;\">Multiple Liquidity Providers. </span></h3>\r\n		<span style=\"font-size:14px;\">Can you imagine having parallel access to multiple FOREX and CFDs liquidity providers? We can give it to you. In TradeMUX you can trade on Multiple Liquidity providers via single GUI</span><br />\r\n		&nbsp;</div>\r\n	<div>\r\n		<div>\r\n			<h3>\r\n				<span style=\"font-size:14px;\">One click trading.</span></h3>\r\n			<span style=\"font-size:14px;\">Submit limit, stop or market orders with predefined stop loss and take profit in just ONE CLICK. Close or modify positions in one click. TradeMUX offers tools that will allow you to act quickly when the market is volatile and there is no time for unnecessary actions.</span></div>\r\n	</div>\r\n	<div>\r\n		<br />\r\n		<div>\r\n			<h3>\r\n				<span style=\"font-size:14px;\">Trading from charts.</span></h3>\r\n			<span style=\"font-size:14px;\">Open pending order (stop or limit) by dragging and dropping &quot;Sell&quot; and &quot;Buy&quot; buttons from any panel on the chart. Modify your orders and setup stop-losses and take profits on the chart.</span></div>\r\n		<div>\r\n			&nbsp;</div>\r\n		<div>\r\n			<h3>\r\n				<span style=\"font-size:14px;\">Bulk order management.</span></h3>\r\n			<span style=\"font-size:14px;\">On the TradeMUX trading platform you can open basket orders, delete all pending orders and close all open positions at once. You can also close positions or delete pending orders by instrument as well as NET them.</span></div>\r\n	</div>\r\n	<p>\r\n		&nbsp;</p>\r\n</div>\r\n<div class=\"clear\">\r\n	&nbsp;</div>\r\n<br />\r\n<div>\r\n	<h3>\r\n		TradeMUX FOREX and CFDs trading platform screenshots</h3>\r\n	<div class=\"gallery-box\">\r\n		<div class=\"sigplus-gallery sigplus-left sigplus-clear\" id=\"galleryformblock\">\r\n			<ul>\r\n				<li>\r\n					<a href=\"/uploads/images/trading/1.png\"><img alt=\"hft algo trading\" height=\"90\" src=\"/uploads/images/trading/preview/1.png\" width=\"196\" /></a></li>\r\n				<li>\r\n					<a href=\"/uploads/images/trading/2.png\"><img alt=\"news trading\" height=\"90\" src=\"/uploads/images/trading/preview/2.png\" width=\"196\" /></a></li>\r\n				<li>\r\n					<a href=\"/uploads/images/trading/3.png\"><img alt=\"scalping trading\" height=\"90\" src=\"/uploads/images/trading/preview/3.png\" width=\"196\" /></a></li>\r\n				<li>\r\n					<a href=\"/uploads/images/trading/4.png\"><img alt=\"one click trading\" height=\"90\" src=\"/uploads/images/trading/preview/4.png\" width=\"196\" /></a></li>\r\n			</ul>\r\n		</div>\r\n	</div>\r\n	<div class=\"clear\">\r\n		&nbsp;</div>\r\n</div>\r\n','2015-02-18 17:14:39','2015-05-25 14:50:43','Forex and CFDs trading platform for scalpers, news &amp; hft','hft algo trading, news trading, scalping trading, trading platform, one click trading, low latency trading','TradeMUX is an ultra low-latecny trading platform for FOREX and CFDs trading. Perfectly suited for Scalping, News and HFT trading.'),(65,9,'Advanced FOREX and CFDs charts','advanced_charts','<div class=\"one-two first\">\r\n  <img class=\"image-center image-big\" src=\"/uploads/images/cat_charts.png\" />\r\n</div>\r\n<div class=\"one-two last\">\r\n  <ul class=\"list-arrowright\">\r\n    <li>Tick charts</li>\r\n    <li>Custom periodicity charts</li>\r\n    <li>Charts overlay</li>\r\n    <li>Last price on the charts</li>\r\n  </ul>\r\n</div>','<div class=\"one-two first\">\r\n	<div class=\"avPlayerWrapper\">\r\n		<div class=\"avPlayerContainer\" style=\"width:434px;\">\r\n			<div class=\"avPlayerBlock\">\r\n				<iframe frameborder=\"0\" height=\"250\" src=\"http://player.vimeo.com/video/124293293?portrait=0\" title=\"FOREX and CFDs charting software\" width=\"434\"></iframe></div>\r\n		</div>\r\n	</div>\r\n</div>\r\n<div class=\"one-two last\">\r\n	<div>\r\n		<h3>\r\n			Tick charts and custom periodicity charts.</h3>\r\n		<span style=\"font-size:14px;\">We &nbsp;allow traders to build charts of any periodicity they want (15 ticks, 1 minute, 90 seconds, 7 hours, 3 days etc.)</span></div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		<h3>\r\n			Charts overlay.</h3>\r\n		<span style=\"font-size:14px;\">If you want to see the correlation of different financial instruments with each other you can easily do it by building all charts in one window. Watch how different trading symbols are correlated with each other in real time mode on different time scales.</span></div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		<h3>\r\n			True prices.</h3>\r\n		<span style=\"font-size:14px;\">Our tick charts are build without quotes throttling. See the prices exactly the same as they are comming from Liquidity Providers</span></div>\r\n</div>\r\n<div class=\"clear\">\r\n	&nbsp;</div>\r\n<br />\r\n<div>\r\n	<h3>\r\n		TradeMUX FOREX and CFDs trading platform screenshots</h3>\r\n	<div class=\"gallery-box\">\r\n		<div class=\"sigplus-gallery sigplus-left sigplus-clear\" id=\"galleryformblock\">\r\n			<ul>\r\n				<li>\r\n					<a href=\"/uploads/images/charts/FOREX and CFDs trading platform advanced charts image 1.png\"><img alt=\"charting software\" height=\"90\" src=\"/uploads/images/charts/preview/1.png\" width=\"196\" /></a></li>\r\n				<li>\r\n					<a href=\"/uploads/images/charts/FOREX and CFDs trading platform advanced charts image 2.png\"><img alt=\"forex charting software\" height=\"90\" src=\"/uploads/images/charts/preview/2.png\" width=\"196\" /></a></li>\r\n				<li>\r\n					<a href=\"/uploads/images/charts/FOREX and CFDs trading platform advanced charts image 3.png\"><img alt=\"cfds charting software\" height=\"90\" src=\"/uploads/images/charts/preview/3.png\" width=\"196\" /></a></li>\r\n				<li>\r\n					<a href=\"/uploads/images/charts/FOREX and CFDs trading platform advanced charts image 4.png\"><img alt=\"forex ticks charts\" height=\"90\" src=\"/uploads/images/charts/preview/4.png\" width=\"196\" /></a></li>\r\n			</ul>\r\n		</div>\r\n	</div>\r\n	<div class=\"clear\">\r\n		&nbsp;</div>\r\n</div>\r\n','2015-02-18 17:14:58','2015-05-18 16:37:15','FOREX and CFDs trading platform, charting software and cahrts','Charting software, forex charting software, cfds charting software, forex tick charts, cfds tick charts, forex tick quotes, cfds tick quotes','Brokerage software -  trading platform with tick charts, custom periodicity charts, charts overlay.'),(66,11,'SAAS Brokerage Solution','saas_brokerage_solution','','<div class=\"one-two first\">\r\n	<h3 style=\"text-align: justify;\">\r\n		<span style=\"font-size:14px;\"><strong>Brokerage Software as a Service (SAAS) </strong>is a solution that provides the entire technological infrastructure necessary to run your FOREX | CFDs brokerage business with no costs for purchasing servers, switches or software.</span></h3>\r\n	<div style=\"text-align: justify;\">\r\n		<span style=\"font-size:14px;\">All a broker needs to run its business is hosted and managed by TradeMUX on our servers. This solution not only brings in low infrastructure cost but also removes the maintenance cost associated with owning computing resource. TradeMUX will manage all hardware, software updating, and physical and software security tasks.</span><br />\r\n		&nbsp;</div>\r\n	<h3 style=\"text-align: justify;\">\r\n		<strong><span style=\"font-size:14px;\">You will get complete FOREX | CFDs brokerage solution at low cost. SAAS FOREX | CFDs Brokerage Solution will include:</span></strong></h3>\r\n	<ul class=\"list-arrowright\">\r\n		<li>\r\n			<span style=\"font-size:14px;\">Trading server located in New York or London by your choice.</span></li>\r\n		<li>\r\n			<a href=\"http://trademux.net/trading_platform/\" target=\"_blank\"><span style=\"font-size:14px;\">Desktop Trading platform for FOREX and CFDs trading.</span></a></li>\r\n		<li>\r\n			<a href=\"http://trademux.net/broker_dealer_backoffice.html\" target=\"_blank\"><span style=\"font-size:14px;\">Forex and CFDs Broker Dealer Backoffice where you can manage users, accounts instruments etc.</span></a></li>\r\n		<li>\r\n			<a href=\"http://trademux.net/stp_bridge.html\" target=\"_blank\"><span style=\"font-size:14px;\">Bridge to liquidity provider</span></a></li>\r\n		<li>\r\n			<span style=\"font-size:14px;\">24x6 support.</span></li>\r\n	</ul>\r\n</div>\r\n<div class=\"one-two last\">\r\n	<strong>Talk to TradeMUX Sales Representative today:</strong>\r\n	<div id=\"feedbackformblock\" type=\"saas\">\r\n		<img alt=\"Loading ...\" src=\"/images/ajax-loader.gif\" /></div>\r\n</div>\r\n<div class=\"clear\">\r\n	&nbsp;</div>\r\n','2015-02-18 17:15:39','2015-05-18 16:13:02','SAAS FOREX and CFDs brokerage solution.','forex broker software, forex brokerage software, forex brokerage solution, cfds broker software, cfds brokerage software, cfds brokerage solution','Brokerage SAAS is a solution that provides the entire technological infrastructure necessary to run your FOREX | CFDs brokerage business'),(67,11,'Complete brokerage solution','complete_brokerage_solution','','<div class=\"one-two first\">\r\n	<h3 style=\"text-align: justify;\">\r\n		<span style=\"font-size:14px;\">Complete FOREX and CFDs brokerage software hosted on your hardware.</span></h3>\r\n	<p style=\"text-align: justify;\">\r\n		<span style=\"font-size:14px;\">TradeMUX FOREX and CFDs brokerage software can be deployed on your hardware by our specialists. We will analyze your business model and recommend hardware modifications to meet your needs.&nbsp;</span></p>\r\n	<h3>\r\n		<span style=\"font-size:14px;\">You will get turnkey online broker dealer software solution that will include:</span></h3>\r\n	<ul class=\"list-arrowright\">\r\n		<li>\r\n			<a href=\"http://trademux.net/trading_platform/\" target=\"_blank\"><span style=\"font-size:14px;\">White labeled desktop trading platform for FOREX and CFDs trading.</span></a></li>\r\n		<li>\r\n			<a href=\"http://trademux.net/trading_server_for_forex_and_cfds_trading.html\" target=\"_blank\"><span style=\"font-size:14px;\">Trading server: ticker plants, smart order routing engine, reporting server, execution management system, historical databases</span></a>.</li>\r\n		<li>\r\n			<span style=\"font-size:14px;\">Backup server.</span></li>\r\n		<li>\r\n			<span style=\"font-size:14px;\"><a href=\"http://trademux.net/broker_dealer_backoffice.html\" target=\"_blank\"><span style=\"font-size:14px;\">FOREX | CFDs Broker Dealer Backoffice</span></a> where you can manage users, accounts instruments etc.</span></li>\r\n		<li>\r\n			<a href=\"http://trademux.net/stp_bridge.html\" target=\"_blank\"><span style=\"font-size:14px;\">Integration with your liquidity providers (Forex, CFDs)</span></a>.</li>\r\n		<li>\r\n			<span style=\"font-size:14px;\">Integration with website and CRM.</span></li>\r\n		<li>\r\n			<span style=\"font-size:14px;\">Integration with payment system.</span></li>\r\n		<li>\r\n			<span style=\"font-size:14px;\">24x6 support.</span></li>\r\n	</ul>\r\n</div>\r\n<div class=\"one-two last\">\r\n	<strong>Talk to TradeMUX Sales Representative today:</strong>\r\n	<div id=\"feedbackformblock\" type=\"turnkey\">\r\n		<img alt=\"Loading ...\" src=\"/images/ajax-loader.gif\" /></div>\r\n</div>\r\n<div class=\"clear\">\r\n	&nbsp;</div>\r\n','2015-02-18 17:15:53','2015-05-18 16:13:57','FOREX and CFDs brokerage software','forex broker software, forex brokerage software, forex brokerage solution, cfds broker software, cfds brokerage software, cfds brokerage solution','Complete forex and cfds brokerage software hosted on your hardware. Turnkey solution for your online FX, Forex, CFDs broker dealer business.'),(68,11,'Custom Solution','custom_solution','','<div class=\"one-two first\">\r\n	<h3 style=\"text-align: justify;\">\r\n		<span style=\"font-size:14px;\">TradeMUX develops custom software that fits exactly broker dealer needs.</span></h3>\r\n	<p style=\"text-align: justify;\">\r\n		<span style=\"font-size:14px;\">TradeMUX is developed by experts with experience writing high frequency automated trading systems. Our HFT systems are successfully trading on multiple FOREX ECNs/MTFs. We have experience developing an FX ECN currently live in the USA, ground-up development of Feed Handlers, OMS and Risks Management systems. We can work with your team to create apps that fit exactly what your team needs.</span></p>\r\n	<h3 style=\"text-align: justify;\">\r\n		<span style=\"font-size:14px;\">Tools for Brokers</span></h3>\r\n	<p style=\"text-align: justify;\">\r\n		<span style=\"font-size:14px;\">We can cut hours of data entry tasks by perfectly tailoring software. We can eliminate error-prone duplication by integrating systems. We can improve decision making by more quickly synthesizing business data. We can make your business more efficient.</span></p>\r\n	<h3 style=\"text-align: justify;\">\r\n		<span style=\"font-size:14px;\">Brokerage software customization</span></h3>\r\n	<p style=\"text-align: justify;\">\r\n		<span style=\"font-size:14px;\">The TradeMUX solution is plug-in capable with hooks at all levels of the system. We can create quickly front-end and back-end features as stand alone plug-ins</span>.</p>\r\n</div>\r\n<div class=\"one-two last\">\r\n	<strong>Talk to TradeMUX Sales Representative today:</strong>\r\n	<div id=\"feedbackformblock\" type=\"custom\">\r\n		<img alt=\"Loading ...\" src=\"/images/ajax-loader.gif\" /></div>\r\n</div>\r\n<div class=\"clear\">\r\n	&nbsp;</div>\r\n','2015-02-18 17:16:09','2015-05-18 16:23:02','custom software development for forex, cfds brokerage','Brokerage software development, financial software development, ecn software, mtf software, tools for brokers, custom Brokerage software.','TradeMUX develops custom software that fits exactly broker dealer needs.'),(69,11,'FX and CFDs ECN Solution','fx_and_cfds_ecn_solution','','<div class=\"one-two first\">\r\n	<p style=\"text-align: justify;\">\r\n		<span style=\"font-size:14px;\"><strong>FOREX and CFDs ECN Software Solution&nbsp;</strong>provides all necessary to run your own FOREX / CFDs ECN. Aggregate liquidity from multiple sources and make it available for trading to your clients. Use self clearing functionality, match clients&#39; orders and become an ECN FX / CFDs broker.</span></p>\r\n	<h3 style=\"text-align: justify;\">\r\n		<strong style=\"font-size: 14px; line-height: 1.7em;\">TradeMUX ECN Software Solution for FOREX and CFDs markets includes:</strong></h3>\r\n	<ul class=\"list-arrowright\">\r\n		<li>\r\n			<a href=\"http://trademux.net/liquidity_aggregator.html\" target=\"_blank\"><span style=\"font-size:14px;\">Forex and CFDs Liquidity Aggregator </span></a></li>\r\n		<li>\r\n			<span style=\"font-size:14px;\">Matching Engine</span></li>\r\n		<li>\r\n			<a href=\"http://trademux.net/trading_platform/\" target=\"_blank\"><span style=\"font-size:14px;\">White labeled desktop trading platform for FOREX and CFDs trading</span></a>.</li>\r\n		<li>\r\n			<a href=\"http://trademux.net/trading_server_for_forex_and_cfds_trading.html\" target=\"_blank\"><span style=\"font-size:14px;\">Trading server: ticker plants, smart order routing engine, reporting server, execution management system, historical databases.</span></a></li>\r\n		<li>\r\n			<span style=\"font-size:14px;\">Backup server.</span></li>\r\n		<li>\r\n			<a href=\"http://trademux.net/broker_dealer_backoffice.html\" target=\"_blank\"><span style=\"font-size:14px;\">FOREX | CFDs Boker Dealer Backoffice where you can manage users, accounts instruments etc</span></a>.</li>\r\n		<li>\r\n			<a href=\"http://trademux.net/stp_bridge.html\" target=\"_blank\"><span style=\"font-size:14px;\">Integration with your liquidity providers.</span></a></li>\r\n		<li>\r\n			<span style=\"font-size:14px;\">Integration with website and CRM.</span></li>\r\n		<li>\r\n			<span style=\"font-size:14px;\">Integration with payment system.</span></li>\r\n		<li>\r\n			<span style=\"font-size:14px;\">24x6 support.</span></li>\r\n	</ul>\r\n</div>\r\n<div class=\"one-two last\">\r\n	<span style=\"font-size:14px;\"><strong>Talk to TradeMUX Sales Representative today:</strong></span>\r\n	<div id=\"feedbackformblock\" type=\"ecn\">\r\n		<span style=\"font-size:14px;\"><img alt=\"Loading ...\" src=\"/images/ajax-loader.gif\" /></span></div>\r\n</div>\r\n<div class=\"clear\">\r\n	&nbsp;</div>\r\n','2015-04-06 12:55:39','2015-05-18 16:17:42','ECN Software Solution for FOREX and CFDs brokers','ECN software solution, Forex liquidity aggregation, Forex liquidity aggregator, cfds liquidity aggregator, cfds liquidity aggretation','ECN Software Solution provides all necessary to run your own FOREX and CFDs ECN. Aggregate liquidity from multiple liquidity sources.'),(76,0,'Request Demo','request_demo','','<div class=\"one-three first\">\r\n	<div id=\"rt-sidebar-a\">\r\n		<div class=\"rt-sidebar-inner\">\r\n			<p style=\"margin-top: -25px; padding-top: 30px;padding-bottom:150px; min-height: 200px\">\r\n				<strong>Sales Department</strong><br />\r\n				Skype: trademux.platform<br />\r\n				Phone: +44 20 3290 4777<br />\r\n				E mail: sales@trademux.org</p>\r\n		</div>\r\n	</div>\r\n</div>\r\n<div class=\"two-three last\">\r\n	<div id=\"feedbackformblock\" type=\"requestdemo\">\r\n		<img alt=\"Loading ...\" src=\"/images/ajax-loader.gif\" /></div>\r\n</div>\r\n<div class=\"clear\">\r\n	&nbsp;</div>\r\n','2015-04-09 12:50:58','2015-04-09 16:59:01','','TradeMUX Demo Request','TradeMUX Demo Request'),(70,9,'MQL4 and Algo Trading - ideal Solution for News, Scalping and HFT strategies','mql4_algo_trading','<div class=\"one-two first\">\r\n  <img class=\"image-center image-big\" src=\"/uploads/images/mql4algo/1.png\" />\r\n</div>\r\n<div class=\"one-two last\">\r\n  <ul class=\"list-arrowright\">\r\n<li>Use MQL4 in low-latency trading environment</li>\r\n<li>Use MQL4 Expert Advisors (EAs)</li>\r\n<li>Use MQL4 Indicators</li>\r\n<li>Use MQL4 Scripts</li>\r\n<li>Use Alerts to quickly automate your trading strategy</li>\r\n<li>Perfect solution for News and HFT traders</li>\r\n  </ul>\r\n</div>','<div class=\"one-two first\">\r\n	<div class=\"avPlayerWrapper\">\r\n		<div class=\"avPlayerContainer\" style=\"width:434px;\">\r\n			<div class=\"avPlayerBlock\">\r\n				<iframe frameborder=\"0\" height=\"250\" src=\"http://player.vimeo.com/video/123685061?portrait=0\" title=\"MQL4 HFT, News and Scalping trading\" width=\"434\"></iframe></div>\r\n		</div>\r\n	</div>\r\n</div>\r\n<div class=\"one-two last\">\r\n	<div>\r\n		<h3>\r\n			<span style=\"font-size:14px;\">MQL4 compatible.</span></h3>\r\n		<span style=\"font-size:14px;\">It&#39;s simple to use what you&#39;ve built in MT4. Use scripts, indicators and experts advisors written in MQL4 in a low latency TradeMUX trading environment.</span></div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		<h3>\r\n			Low-latecny MQL4 trading environment.</h3>\r\n		<span style=\"font-size: 14px; line-height: 1.7em;\">Your scalping, news and HFT strategies will be tarding more profitable. Orders are processed and sent to liquidity providers in 30 to 150 microseconds. That means less slippage, higher fill ratios, better prices and more profitable trading as result.&nbsp;</span></div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		<h3>\r\n			FOREX and CFDs arbitrage strategies.</h3>\r\n		<span style=\"font-size: 14px; line-height: 1.7em;\">TradeMUX allows parallel access to multiple liquidity providers in single trading platform. You can easily create arbitrage strategies between multiple LPs using MQL4 or TradeMUX Alerts.&nbsp;</span></div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		<h3>\r\n			Use Alerts to quickly automate trading strategies.</h3>\r\n		<span style=\"font-size: 14px; line-height: 1.7em;\">TradeMUX alerts are easy to setup. They allow sumbission of pending order, cancel orders, and open or close position if a predefined event happens.&nbsp;</span></div>\r\n	<p>\r\n		&nbsp;</p>\r\n</div>\r\n<div class=\"clear\">\r\n	&nbsp;</div>\r\n<br />\r\n<div>\r\n	<h3>\r\n		TradeMUX FOREX and CFDs trading platform screenshots</h3>\r\n	<div class=\"gallery-box\">\r\n		<div class=\"sigplus-gallery sigplus-left sigplus-clear\" id=\"galleryformblock\">\r\n			<ul>\r\n				<li>\r\n					<a href=\"/uploads/images/mql4algo/1.png\"><img alt=\"low latency mql4\" height=\"90\" src=\"/uploads/images/mql4algo/preview/1.png\" width=\"196\" /></a></li>\r\n				<li>\r\n					<a href=\"/uploads/images/mql4algo/2.png\"><img alt=\"mql4 algo trading\" height=\"90\" src=\"/uploads/images/mql4algo/preview/2.png\" width=\"196\" /></a></li>\r\n				<li>\r\n					<a href=\"/uploads/images/mql4algo/3.png\"><img alt=\"mql4 hft trading\" height=\"90\" src=\"/uploads/images/mql4algo/preview/3.png\" width=\"196\" /></a></li>\r\n				<li>\r\n					<a href=\"/uploads/images/mql4algo/4.png\"><img alt=\"mql4 news trading\" height=\"90\" src=\"/uploads/images/mql4algo/preview/4.png\" width=\"196\" /></a></li>\r\n			</ul>\r\n		</div>\r\n	</div>\r\n	<div class=\"clear\">\r\n		&nbsp;</div>\r\n</div>\r\n','2015-04-06 13:14:08','2015-05-18 16:28:52','Low latecny mql4 and algo trading','low latency mql4 trading, mql4 algo trading, mql4 cfds trading, high performance mql4, mql4 scalping strategies, mql4 hft trading, mql4 news trading','TradeMUX is a low-latecny MQL4 trading environment. Orders are processed and sent to liquidity providers in MICROseconds.'),(72,10,'Broker Dealer Backoffice','broker_dealer_backoffice','','<img alt=\"FOREX and CFDs Backoffice\" class=\"image-left image-middle\" src=\"/uploads/images/FOREX and CFDs Broker Dealer Backoffice Software image main.png\" title=\"Backoffice\" />\r\n<div style=\"margin-left: 505px\">\r\n	<h3>\r\n		TradeMUX FX and CFDs Broker Dealer Backoffice is a comprehensive management and administrative tool tailored to your business processes.</h3>\r\n	<ul class=\"list-arrowright\">\r\n		<li>\r\n			<span style=\"font-size:14px;\">Users and accounts management</span></li>\r\n		<li>\r\n			<span style=\"font-size:14px;\">Hierarchical user structure and customizable access permissions</span></li>\r\n		<li>\r\n			<span style=\"font-size:14px;\">Liquidity providers and price streams management</span></li>\r\n		<li>\r\n			<span style=\"font-size:14px;\">Manage Trading Sessions</span></li>\r\n		<li>\r\n			<span style=\"font-size:14px;\">Markups, commissions and swaps management</span></li>\r\n		<li>\r\n			<span style=\"font-size:14px;\">Real -Time Exposure control</span></li>\r\n		<li>\r\n			<span style=\"font-size:14px;\">Positions and orders management</span></li>\r\n		<li>\r\n			<span style=\"font-size:14px;\">Reporting tools</span></li>\r\n		<li>\r\n			<span style=\"font-size:14px;\">Give Backoffice access to your IBs</span></li>\r\n	</ul>\r\n</div>\r\n<div>\r\n	<h3>\r\n		<span style=\"font-size:14px;\">Users and accounts management.</span></h3>\r\n	<div>\r\n		<span style=\"font-size:14px;\">Create users, accounts and instantly pull client&#39;s information from the platform. Change account details in a few clicks. Have real-time access to financial transactions, including deposits /withdrawals and positions / orders &ndash; enabling a detailed live account view which can improve customer service and risk management.</span><br />\r\n		&nbsp;</div>\r\n	<h3>\r\n		<span style=\"font-size:14px;\">Hierarchical user structure and customizable access permissions.</span></h3>\r\n	<div>\r\n		<span style=\"font-size:14px;\">TradeMUX allows you to easily organize different clients into groups. Different settings can be applied to each group, with no limit on the number of groups that can be created. Example: different margin settings, trading instruments, commission levels, swaps and markups can be applied to each group. All user settings can be inherited from parent group or easily defined for each user on a user by user level.</span><br />\r\n		&nbsp;</div>\r\n	<div>\r\n		<span style=\"font-size:14px;\">TradeMUX has a rule-based settings control that allows you to apply different access rights for different departments and personnel within your organization. Example: &quot;User A&quot; can manage &quot;Group of accounts A&quot; and have view-only access to &quot;Group of accounts B&quot;, &quot;User B&quot; can manage both &quot;Groups of accounts A and B&quot; AND both users will not be able to manage Liquidity providers, Trading sessions, Commissions nor any other parts of the system.</span><br />\r\n		&nbsp;</div>\r\n	<h3>\r\n		<span style=\"font-size:14px;\">Liquidity providers and price streams management.</span></h3>\r\n	<div>\r\n		<span style=\"font-size:14px;\">You can manage as many liquidity providers and price streams as you need. Clients&#39; orders can be routed to external liquidity providers or executed locally. You can switch the routing rules for each client on the fly. Switch your clients between Books without restarting server and changing instruments names.</span><br />\r\n		&nbsp;</div>\r\n	<h3>\r\n		<span style=\"font-size:14px;\">Manage trading sessions.</span></h3>\r\n	<div>\r\n		<span style=\"font-size:14px;\">You can manage trading sessions on an instrument basis. This functionality allows you to tailor your trading hours to your LP setup, client needs and internal processes.</span><br />\r\n		&nbsp;</div>\r\n	<h3>\r\n		<span style=\"font-size:14px;\">Markups, commissions and swaps management.</span></h3>\r\n	<div>\r\n		<span style=\"font-size:14px;\">Markups, commissions and swaps can be setup on an instrument by instrument basis. There is a possibility to markup bid and ask separately to increase profitability. For more usability, swaps can be imported from a file.</span><br />\r\n		&nbsp;</div>\r\n	<h3>\r\n		<span style=\"font-size:14px;\">Real-Time Exposure control</span></h3>\r\n	<div>\r\n		<span style=\"font-size:14px;\">You can view real-time P/L , margin, positions size and match exposure between different books and platforms. All client orders are shown in one place with ability to sort and filter them by any parameter including distance between order price and market price in real-time mode. Exposure by ticker and symbol are also displayed for your convenience. You will have everything you need to understand and control your risk. If custom risk management tools are needed they can be easily integrated or developed as additional plugins.</span><br />\r\n		&nbsp;</div>\r\n	<h3>\r\n		<span style=\"font-size:14px;\">Positions and orders management</span></h3>\r\n	<div>\r\n		<span style=\"font-size:14px;\">As a dealer you can close all clients positions and orders, or open positions and orders on behalf of the client.</span><br />\r\n		&nbsp;</div>\r\n	<h3>\r\n		<span style=\"font-size:14px;\">Reporting tools</span></h3>\r\n	<div>\r\n		<span style=\"font-size:14px;\">You can create reports and filter them inside the platform to know exactly how your business in doing. It is possible to view various system and trading activity for selected accounts by defined period. There is the capability to export reports to XLS, SCV, PDF, HTML and TEXT files. Custom reports can be quickly added to meet your business and compliance needs.</span></div>\r\n	<div>\r\n		&nbsp;</div>\r\n</div>\r\n<div>\r\n	<h3>\r\n		<strong><strong>TradeMUX FOREX and CFDs Broker Dealer Backoffice Screenshots</strong></strong></h3>\r\n	<div class=\"gallery-box\">\r\n		<div class=\"sigplus-gallery sigplus-left sigplus-clear\" id=\"galleryformblock\">\r\n			<ul>\r\n				<li>\r\n					<a href=\"/uploads/images/backoffice/1.png\"><img alt=\"backoffice brokerage software\" height=\"90\" src=\"/uploads/images/backoffice/preview/1.png\" width=\"196\" /></a></li>\r\n				<li>\r\n					<a href=\"/uploads/images/backoffice/2.png\"><img alt=\"brokerage risk control\" height=\"90\" src=\"/uploads/images/backoffice/preview/2.png\" width=\"196\" /></a></li>\r\n				<li>\r\n					<strong><strong><a href=\"/uploads/images/backoffice/3.png\"><img alt=\"broker backoffice\" height=\"90\" src=\"/uploads/images/backoffice/preview/3.png\" width=\"196\" /></a></strong></strong></li>\r\n				<li>\r\n					<a href=\"/uploads/images/backoffice/4.png\"><img alt=\"forex and cfds backoffice\" height=\"90\" src=\"/uploads/images/backoffice/preview/4.png\" width=\"196\" /></a></li>\r\n			</ul>\r\n		</div>\r\n	</div>\r\n</div>\r\n','2015-04-06 15:19:29','2015-05-18 16:39:50','Broker Dealer Backoffice Software for FOREX and CFDs markets','backoffice brokerage software, brokerage risk control, broker backoffice, dealer backoffice, forex backoffice, cfds backoffice','TradeMUX Broker Dealer Backoffice management software for CFDs and Forex markets.'),(71,9,'Multiple Account Management (MAM)','multiple_account_management_mam','<div class=\"one-two first\">\r\n  <img class=\"image-center image-big\" src=\"/uploads/images/mam/1.png\" />\r\n</div>\r\n<div class=\"one-two last\">\r\n  <ul class=\"list-arrowright\">\r\n<li>Trade multiple accounts in single trading platform</li>\r\n<li>2 allocation methods (Lot, Proportional)</li>\r\n<li>Manage multiple master accounts having different strategies</li>\r\n<li>All order types accepted (Market, Limit, Stop, OCO, Trailing, Netting, Close all, Close by)</li>\r\n<li>Allows MQL4 Expert Advisor (EA) trading</li>\r\n  </ul>\r\n</div>','<div class=\"one-two first\">\r\n	<div class=\"avPlayerWrapper\">\r\n		<div class=\"avPlayerContainer\" style=\"width:434px;\">\r\n			<div class=\"avPlayerBlock\">\r\n				<iframe frameborder=\"0\" height=\"250\" src=\"http://player.vimeo.com/video/123828867?portrait=0\" title=\"FOREX and CFDs Multiple Account Management (MAM)\" width=\"434\"></iframe></div>\r\n		</div>\r\n	</div>\r\n</div>\r\n<div class=\"one-two last\">\r\n	<div style=\"text-align: justify;\">\r\n		<h3>\r\n			Multi Account Management (MAM)</h3>\r\n		<span style=\"font-size:14px;\"><strong>Multi Account Management (MAM) plugin</strong> fucntionality is designed for money managers. It alows money manager trading FOREX and CFDs to efficiently manage multiple accounts from a single interface. With the TradeMUX platform, money managers can quickly and easily, place orders across client accounts keeping focused on their trading.</span><br />\r\n		<br />\r\n		<strong><span style=\"font-size:14px;\">Key benefits:</span></strong></div>\r\n	<div>\r\n		<ul class=\"list-arrowright\">\r\n			<li>\r\n				<span style=\"font-size:14px;\">Trade multiple accounts on a single trading platform.</span></li>\r\n			<li>\r\n				<span style=\"font-size:14px;\">Manage accounts on different FOREX | CFDs brokers or liquidity providers from a single trading platform.</span></li>\r\n			<li>\r\n				<span style=\"font-size:14px;\">2 allocation methods (Lot, Proportional).</span></li>\r\n			<li>\r\n				<span style=\"font-size:14px;\">Manage multiple master accounts running different strategies.</span></li>\r\n			<li>\r\n				<span style=\"font-size:14px;\">All order types accepted (Market, Limit, Stop, OCO, Trailing, Netting, Close all, Close by).</span></li>\r\n			<li>\r\n				<a href=\"http://trademux.net/mql4_and_algo_trading_ideal_solution_for_news_scalping_and_hft_strategies.html\" target=\"_blank\"><span style=\"font-size:14px;\">Low latecny MQL4 Expert Advisor (EA) trading.</span></a></li>\r\n			<li>\r\n				<span style=\"font-size:14px;\">Copy trades from TradeMUX to MT4 and vice versa.</span></li>\r\n		</ul>\r\n	</div>\r\n</div>\r\n<div class=\"clear\">\r\n	&nbsp;</div>\r\n<br />\r\n<div>\r\n	<h3>\r\n		TradeMUX FOREX and CFDs trading platform screenshots</h3>\r\n	<div class=\"gallery-box\">\r\n		<div class=\"sigplus-gallery sigplus-left sigplus-clear\" id=\"galleryformblock\">\r\n			<ul>\r\n				<li>\r\n					<a href=\"/uploads/images/mam/1.png\"><img alt=\"forex mam plugin\" height=\"90\" src=\"/uploads/images/mam/preview/1.png\" width=\"196\" /></a></li>\r\n				<li>\r\n					<a href=\"/uploads/images/mam/2.png\"><img alt=\"mam software\" height=\"90\" src=\"/uploads/images/mam/preview/2.png\" width=\"196\" /></a></li>\r\n				<li>\r\n					<a href=\"/uploads/images/mam/3.png\"><img alt=\"mam module\" height=\"90\" src=\"/uploads/images/mam/preview/3.png\" width=\"196\" /></a></li>\r\n				<li>\r\n					<a href=\"/uploads/images/mam/4.png\"><img alt=\"multiple account management plugin\" height=\"90\" src=\"/uploads/images/mam/preview/4.png\" width=\"196\" /></a></li>\r\n			</ul>\r\n		</div>\r\n	</div>\r\n	<div class=\"clear\">\r\n		&nbsp;</div>\r\n</div>\r\n','2015-04-06 13:21:13','2015-05-18 16:31:02','FOREX and CFDs MAM. FX and CFDs Multiple Account Managment','mam plugin, mam module, mam forex, mam cfds, forex multiple account management plugin, cfds multiple account management plugin, mam software','TradeMUX Multi Account Management (MAM) module allows money manager trading FOREX and CFDs to manage multiple accounts from a single interface.'),(73,10,'Liquidity Aggregator','liquidity_aggregator','','<img alt=\"FOREX and CFDs Liquidity Aggregator\" class=\"image-left image-middle\" src=\"/uploads/images/liquidity_aggregator.png\" title=\"Liquidity Aggregator\" />\r\n<div style=\"margin-left: 505px\">\r\n	<h3 style=\"text-align: justify;\">\r\n		<strong><span style=\"font-size:14px;\">Liquidity aggregator is used to aggregate liquidity from several Forex or CFDs liquidity providers.</span></strong></h3>\r\n	<p style=\"text-align: justify;\">\r\n		<strong><span style=\"font-size:14px;\">TradeMUX Liquidity Aggregator provides two main functions:</span></strong></p>\r\n	<ul class=\"list-arrowright\">\r\n		<li style=\"text-align: justify;\">\r\n			<span style=\"font-size:14px;\">It &nbsp;allows traders to compare prices from different liquidity venues such as banks, global market makers or ECNs like Currenex, FXall, and Hotspot FX among others. This allows traders to trade with many participants using a single trading terminal. &nbsp;</span></li>\r\n		<li style=\"text-align: justify;\">\r\n			<span style=\"font-size:14px;\">It allows price feeds aggregation from several providers into a single price stream thus delivering to end-users the best execution prices available and reduces the risk of poor liquidity during volatile market periods.&nbsp;</span></li>\r\n	</ul>\r\n	<p style=\"text-align: justify;\">\r\n		&nbsp;</p>\r\n	<h3 style=\"text-align: justify;\">\r\n		<strong><span style=\"font-size:14px;\">Cost saving</span></strong></h3>\r\n	<ul class=\"list-arrowright\">\r\n		<li style=\"text-align: justify;\">\r\n			<span style=\"font-size:14px;\">TradeMUX FX (FOREX) and CFDs liquidity aggregator in combination with TradeMUX Trading Server, Trading Platform and Backoffice allows brokers to significantly reduce their expenses on use of third party aggregator services.</span></li>\r\n		<li style=\"text-align: justify;\">\r\n			<span style=\"font-size:14px;\">No need for additional hardware investment.</span></li>\r\n		<li style=\"text-align: justify;\">\r\n			<span style=\"font-size:14px;\">The TradeMUX aggregator allows brokers to do self clearing thus saving costs on prime brokerage clearing services.</span></li>\r\n		<li style=\"text-align: justify;\">\r\n			<span style=\"font-size:14px;\">Narrow spreads help benefit from better pricing.</span></li>\r\n		<li style=\"text-align: justify;\">\r\n			<span style=\"font-size:14px;\">Faster execution. &nbsp;Low latency trading environment gives you opportunity to capture the best market price faster than competitors</span></li>\r\n	</ul>\r\n</div>\r\n<h3 style=\"text-align: justify;\">\r\n	<strong><span style=\"font-size:14px;\">Smart Order Routing</span></strong></h3>\r\n<ul class=\"list-arrowright\">\r\n	<li style=\"text-align: justify;\">\r\n		<span style=\"font-size:14px;\">An order can be split into the chunks which are sent to the respective counterparties based on the price, time and other attributes of the quotes from these counterparties.&nbsp;</span></li>\r\n	<li style=\"text-align: justify;\">\r\n		<span style=\"font-size:14px;\">Route the whole order to a single liquidity provider who is chosen by an order routing algorithm embedded into an aggregator.</span></li>\r\n</ul>\r\n<p style=\"text-align: justify;\">\r\n	&nbsp;</p>\r\n<h3 style=\"text-align: justify;\">\r\n	<strong><span style=\"font-size:14px;\">Wide range of order types</span></strong></h3>\r\n<ul class=\"list-arrowright\">\r\n	<li style=\"text-align: justify;\">\r\n		<span style=\"font-size:14px;\">Market, Limit, Stop, OCO</span></li>\r\n	<li style=\"text-align: justify;\">\r\n		<span style=\"font-size:14px;\">GTC, IOC, FOK</span></li>\r\n	<li style=\"text-align: justify;\">\r\n		<span style=\"font-size:14px;\">Other order types can be added by request</span></li>\r\n</ul>\r\n<div class=\"clear\">\r\n	&nbsp;</div>\r\n','2015-04-06 15:21:34','2015-05-18 16:40:39','forex and cfds liquidity aggregator','forex liquidity aggregator, forex liquidity aggregation, cfds liquidity aggregator, cfds liquidity aggregation','TradeMUX Forex and CFDs Liquidity aggregator is used to aggregate liquidity from several liquidity providers.'),(74,10,'STP Bridge','stp_bridge','','<div class=\"one-two first\">\r\n	<div class=\"avPlayerWrapper\">\r\n		<div class=\"avPlayerContainer\" style=\"width:434px;\">\r\n			<div class=\"avPlayerBlock\">\r\n				<iframe frameborder=\"0\" height=\"250\" src=\"http://player.vimeo.com/video/123938881?portrait=0\" title=\"Videos Player\" width=\"434\"></iframe></div>\r\n		</div>\r\n	</div>\r\n</div>\r\n<div class=\"one-two last\">\r\n	<h3 style=\"text-align: justify;\">\r\n		<span style=\"font-size:14px;\"><strong>TradeMUX FOREX | CFDs STP Bridge supports complex order routing and allows brokers to implement a Straight Through Processing (STP) business model.</strong></span></h3>\r\n	<div style=\"text-align: justify;\">\r\n		<span style=\"font-size:14px;\"><strong>Key benefits:</strong></span></div>\r\n	<div>\r\n		<ul class=\"list-arrowright\">\r\n			<li>\r\n				<span style=\"font-size:14px;\">Ultra-low latency and fast execution. Multiple Microsecond execution speed (watch video on this page for demonstration).</span></li>\r\n			<li>\r\n				<span style=\"font-size:14px;\">Limit Orders support (GTC, IOC, FOK)</span></li>\r\n			<li>\r\n				<span style=\"font-size:14px;\">Partial fills support</span></li>\r\n			<li>\r\n				<span style=\"font-size:14px;\">Parallel connectivity to multiple liquidity providers (LPs)</span></li>\r\n			<li>\r\n				<span style=\"font-size:14px;\">Multi-Asset covering FOREX, CFDs, Indices</span></li>\r\n			<li>\r\n				<span style=\"font-size:14px;\">Complex and dynamic order routing rules</span></li>\r\n			<li>\r\n				<span style=\"font-size:14px;\">Switch your clients between Books without restarting server and changing instrument name</span></li>\r\n		</ul>\r\n	</div>\r\n</div>\r\n<div class=\"clear\">\r\n	&nbsp;</div>\r\n<br />\r\n<div>\r\n	<h3 style=\"text-align: center;\">\r\n		TradeMUX gives you the opportunity to inexpensively and easily connect to a wide range of FOREX and CFDs liquidity providers. This list is continuously growing as new liquidity providers are added.</h3>\r\n	<img alt=\"FOREX and CFDs STP bridge software\" class=\"image-center\" src=\"/uploads/images/bridge.png\" title=\"FOREX and CFDs STP bridge software\" />\r\n	<div class=\"clear\">\r\n		&nbsp;</div>\r\n</div>\r\n','2015-04-06 15:35:48','2015-05-18 16:43:14','STP Bridge to FOREX and CFDs liquidity providers','forex bridge, forex liquidity bridge, forex stp bridge, forex bridge software, forex order routing engine','TradeMUX FOREX | CFDs STP Bridge supports complex order routing and allows brokers to implement a Straight Through Processing (STP) business model'),(75,11,'Solution for Traders','solution_for_traders','','<div class=\"one-two first\">\r\n	<h3 style=\"text-align: justify;\">\r\n		<span style=\"font-size:14px;\"><strong>TradeMUX is developed by traders to make trading more efficient and profitable. </strong></span></h3>\r\n	<p style=\"text-align: justify;\">\r\n		<span style=\"font-size:14px;\">We have developed a lot of tools to make your trading life easier. We &#39;re glad if you&#39;re trading on the TradeMUX platform. When<span style=\"line-height: 1.7em;\">&nbsp;you have ideas on how to improve TradeMUX trading platform please contact us. If your ideas are supported by other traders we will develop and integrate them in our software.</span></span><br />\r\n		<br />\r\n		<span style=\"font-size: 14px; line-height: 1.7em;\">If you like our high performacne FOREX and CFDs trading platform but your broker does not support it - we can solve this issue.&nbsp;</span><span style=\"font-size: 14px; line-height: 1.7em;\">We will integrate the platform with your broker at our cost and will charge you some fair commission on turnover depending on volume you generate.</span></p>\r\n	<div style=\"text-align: justify;\">\r\n		<span style=\"font-size: 14px; line-height: 1.7em;\">The broker you want us to get integrated needs only one item - &nbsp;they need to have FIX API for integration.&nbsp;</span></div>\r\n	<div style=\"text-align: justify;\">\r\n		&nbsp;</div>\r\n	<div style=\"text-align: justify;\">\r\n		<span style=\"font-size:14px;\">You will get a trading platform connected to your broker and all advantages of low latency execution for more efficient and profitable trading.&nbsp;</span></div>\r\n</div>\r\n<div class=\"one-two last\">\r\n	<strong>Please do not hesitate to contact us now:</strong>\r\n	<div id=\"feedbackformblock\" type=\"for_traders\">\r\n		<img alt=\"Loading ...\" src=\"/images/ajax-loader.gif\" /></div>\r\n</div>\r\n<div class=\"clear\">\r\n	&nbsp;</div>\r\n','2015-04-06 16:51:55','2015-05-18 16:19:31','High Performance FOREX and CFDs trading platform','hft algo trading, news trading, scalping trading, trading platform, one click trading, low latency trading','TradeMUX is developed by traders to make trading more efficient and profitable. Discover the tools to make your trading more efficient and profitable.');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brokers`
--

DROP TABLE IF EXISTS `brokers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brokers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `link` varchar(1000) DEFAULT NULL,
  `poa` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brokers`
--

LOCK TABLES `brokers` WRITE;
/*!40000 ALTER TABLE `brokers` DISABLE KEYS */;
/*!40000 ALTER TABLE `brokers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(1000) NOT NULL,
  `alias` varchar(1000) NOT NULL,
  `description` text,
  `create_date` datetime DEFAULT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_title` varchar(1000) DEFAULT NULL,
  `meta_keywords` varchar(2000) DEFAULT NULL,
  `meta_description` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (11,0,'Solutions','solutions','','2015-02-18 16:49:31','2015-02-18 21:49:31','','',''),(7,0,'Common information','common_information','','2011-02-03 17:59:41','2014-10-06 18:59:57','','',''),(9,0,'Trading Platform','trading_platform','','2011-02-03 18:00:06','2015-11-05 20:02:15','Low-latency Forex, CFDs trading platform','Multiple Account Management (MAM), MQL4, Forex Charting Software, FOREX trading platform, CFDs trading platform','Trading platform and Brokerage Software for FOREX, FX, CFDs broker dealer business'),(10,0,'Products','products','','2014-10-06 22:00:47','2015-02-18 22:16:36','','','');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `confirmations`
--

DROP TABLE IF EXISTS `confirmations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `confirmations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(1000) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `confirmations`
--

LOCK TABLES `confirmations` WRITE;
/*!40000 ALTER TABLE `confirmations` DISABLE KEYS */;
INSERT INTO `confirmations` VALUES (4,'corsair@localhost','b40532a51cfbfcaf49f0002fdbf59bea','2014-11-21 23:56:32'),(2,'corsair@localhost','05d1fd89fbc5b392c40b922b123ef503','2014-11-21 18:04:38'),(3,'corsair@localhost','dd4e664c6d686ebb6e654b1fe0d4a4c7','2014-11-21 18:22:05'),(6,'corsair@localhost','52041c9692df0c179fb2a722df1eeace','2014-12-03 17:42:14'),(7,'corsair@localhost','a3643e2034ee22e3db1ee203bf726e72','2014-12-03 18:01:25'),(10,'corsair@localhost','088ac985c4e1868573d4d91ef8bf3fe1','2014-12-11 20:31:51'),(11,'corsair@localhost','2f1addf290eb62934002ded1c0a85e89','2014-12-11 21:06:20'),(12,'corsairua@gmail.com','f08b7c83bcb84b288ff61c39db1622c5','2014-12-18 17:21:44'),(13,'corsairua@gmail.com','e6d87e71acbecf38f6e6e672ede199e4','2014-12-18 17:24:08'),(14,'corsair@localhost','18ee286a289e0f9613c061550ff5282a','2014-12-24 12:29:13'),(15,'corsair@localhost','1de2c1484762c33dbc2c0af05155be37','2014-12-24 12:30:55'),(18,'pcfx4@grr.la','289349f8397441f8d82a9ad7e76a828b','2014-12-24 13:04:37');
/*!40000 ALTER TABLE `confirmations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `ru_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `i_name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=194 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Afghanistan',NULL),(2,'Albania',NULL),(3,'Algeria',NULL),(4,'Andorra',NULL),(5,'Angola',NULL),(6,'Antigua and Barbuda',NULL),(7,'Argentina',NULL),(8,'Armenia',NULL),(9,'Australia',NULL),(10,'Austria',NULL),(11,'Azerbaijan',NULL),(12,'Bahamas',NULL),(13,'Bahrain',NULL),(14,'Bangladesh',NULL),(15,'Barbados',NULL),(16,'Belarus',NULL),(17,'Belgium',NULL),(18,'Belize',NULL),(19,'Benin',NULL),(20,'Bhutan',NULL),(21,'Bolivia',NULL),(22,'Bosnia and Herzegovina',NULL),(23,'Botswana',NULL),(24,'Brazil',NULL),(25,'Brunei',NULL),(26,'Bulgaria',NULL),(27,'Burkina Faso',NULL),(28,'Burundi',NULL),(29,'Cambodia',NULL),(30,'Cameroon',NULL),(31,'Canada',NULL),(32,'Cape Verde',NULL),(33,'Central African Republic',NULL),(34,'Chad',NULL),(35,'Chile',NULL),(36,'China',NULL),(37,'Colombi',NULL),(38,'Comoros',NULL),(39,'Congo (Brazzaville)',NULL),(40,'Congo',NULL),(41,'Costa Rica',NULL),(42,'Cote d\'Ivoire',NULL),(43,'Croatia',NULL),(44,'Cuba',NULL),(45,'Cyprus',NULL),(46,'Czech Republic',NULL),(47,'Denmark',NULL),(48,'Djibouti',NULL),(49,'Dominica',NULL),(50,'Dominican Republic',NULL),(51,'East Timor (Timor-Leste)',NULL),(52,'Ecuador',NULL),(53,'Egypt',NULL),(54,'El Salvador',NULL),(55,'Equatorial Guinea',NULL),(56,'Eritrea',NULL),(57,'Estonia',NULL),(58,'Ethiopia',NULL),(59,'Fiji',NULL),(60,'Finland',NULL),(61,'France',NULL),(62,'Gabon',NULL),(63,'Gambia',NULL),(64,'Georgia',NULL),(65,'Germany',NULL),(66,'Ghana',NULL),(67,'Greece',NULL),(68,'Grenada',NULL),(69,'Guatemala',NULL),(70,'Guinea',NULL),(71,'Guinea-Bissau',NULL),(72,'Guyana',NULL),(73,'Haiti',NULL),(74,'Honduras',NULL),(75,'Hungary',NULL),(76,'Iceland',NULL),(77,'India',NULL),(78,'Indonesia',NULL),(79,'Iran',NULL),(80,'Iraq',NULL),(81,'Ireland',NULL),(82,'Israel',NULL),(83,'Italy',NULL),(84,'Jamaica',NULL),(85,'Japan',NULL),(86,'Jordan',NULL),(87,'Kazakhstan',NULL),(88,'Kenya',NULL),(89,'Kiribati',NULL),(90,'Korea, North',NULL),(91,'Korea, South',NULL),(92,'Kuwait',NULL),(93,'Kyrgyzstan',NULL),(94,'Laos',NULL),(95,'Latvia',NULL),(96,'Lebanon',NULL),(97,'Lesotho',NULL),(98,'Liberia',NULL),(99,'Libya',NULL),(100,'Liechtenstein',NULL),(101,'Lithuania',NULL),(102,'Luxembourg',NULL),(103,'Macedonia',NULL),(104,'Madagascar',NULL),(105,'Malawi',NULL),(106,'Malaysia',NULL),(107,'Maldives',NULL),(108,'Mali',NULL),(109,'Malta',NULL),(110,'Marshall Islands',NULL),(111,'Mauritania',NULL),(112,'Mauritius',NULL),(113,'Mexico',NULL),(114,'Micronesia',NULL),(115,'Moldova',NULL),(116,'Monaco',NULL),(117,'Mongolia',NULL),(118,'Morocco',NULL),(119,'Mozambique',NULL),(120,'Myanmar',NULL),(121,'Namibia',NULL),(122,'Nauru',NULL),(123,'Nepa',NULL),(124,'Netherlands',NULL),(125,'New Zealand',NULL),(126,'Nicaragua',NULL),(127,'Niger',NULL),(128,'Nigeria',NULL),(129,'Norway',NULL),(130,'Oman',NULL),(131,'Pakistan',NULL),(132,'Palau',NULL),(133,'Panama',NULL),(134,'Papua New Guinea',NULL),(135,'Paraguay',NULL),(136,'Peru',NULL),(137,'Philippines',NULL),(138,'Poland',NULL),(139,'Portugal',NULL),(140,'Qatar',NULL),(141,'Romania',NULL),(142,'Russia',NULL),(143,'Rwanda',NULL),(144,'Saint Kitts and Nevis',NULL),(145,'Saint Lucia',NULL),(146,'Saint Vincent',NULL),(147,'Samoa',NULL),(148,'San Marino',NULL),(149,'Sao Tome and Principe',NULL),(150,'Saudi Arabia',NULL),(151,'Senegal',NULL),(152,'Serbia and Montenegro',NULL),(153,'Seychelles',NULL),(154,'Sierra Leone',NULL),(155,'Singapore',NULL),(156,'Slovakia',NULL),(157,'Slovenia',NULL),(158,'Solomon Islands',NULL),(159,'Somalia',NULL),(160,'South Africa',NULL),(161,'Spain',NULL),(162,'Sri Lanka',NULL),(163,'Sudan',NULL),(164,'Suriname',NULL),(165,'Swaziland',NULL),(166,'Sweden',NULL),(167,'Switzerland',NULL),(168,'Syria',NULL),(169,'Taiwan',NULL),(170,'Tajikistan',NULL),(171,'Tanzania',NULL),(172,'Thailand',NULL),(173,'Togo',NULL),(174,'Tonga',NULL),(175,'Trinidad and Tobago',NULL),(176,'Tunisia',NULL),(177,'Turkey',NULL),(178,'Turkmenistan',NULL),(179,'Tuvalu',NULL),(180,'Uganda',NULL),(181,'Ukraine',NULL),(182,'United Arab Emirates',NULL),(183,'United Kingdom',NULL),(184,'United States',NULL),(185,'Uruguay',NULL),(186,'Uzbekistan',NULL),(187,'Vanuatu',NULL),(188,'Vatican',NULL),(189,'Venezuela',NULL),(190,'Vietnam',NULL),(191,'Yemen',NULL),(192,'Zambia',NULL),(193,'Zimbabwe',NULL);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(32) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `name` varchar(512) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `skype` varchar(255) DEFAULT NULL,
  `activity` varchar(512) DEFAULT NULL,
  `company` varchar(512) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `comment` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `title` varchar(1000) DEFAULT NULL,
  `link` varchar(1000) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `desc` varchar(1000) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,0,0,'Top Menu','','menu','Top Menu',NULL,'2014-10-06 18:55:56'),(3,1,1,'Solutions','','none','',NULL,'2015-02-18 16:08:12'),(13,1,2,'Contact Us','{\"m\":\"content\",\"t\":\"article\",\"p\":{\"alias\":\"contact_us\"}}','article','','2010-12-21 19:05:36','2015-02-18 16:13:58'),(14,1,3,'Request demo','{\"m\":\"content\",\"t\":\"article\",\"p\":{\"alias\":\"request_demo\"}}','article','','2010-12-21 19:05:51','2015-04-09 16:51:12'),(86,20,4,'STP Bridge','{\"m\":\"content\",\"t\":\"article\",\"p\":{\"alias\":\"stp_bridge\"}}','article','','2015-04-06 06:33:21','2015-04-08 09:43:32'),(71,3,0,'SAASÂ Brokerage Solution','{\"m\":\"content\",\"t\":\"article\",\"p\":{\"alias\":\"saas_brokerage_solution\"}}','article','','2014-10-06 22:16:53','2015-04-06 16:32:07'),(80,3,1,'Complete Brokerage Solution','{\"m\":\"content\",\"t\":\"article\",\"p\":{\"alias\":\"complete_brokerage_solution\"}}','article','','2015-02-18 13:27:36','2015-04-29 10:15:14'),(20,1,0,'Brokerage Software','','none','Brokerage Software','2010-12-28 18:20:32','2015-05-13 10:06:04'),(67,20,1,'Trading server','{\"m\":\"content\",\"t\":\"article\",\"p\":{\"alias\":\"trading_server_forex_cfds\"}}','article','','2014-10-06 22:14:00','2015-05-18 15:13:07'),(79,53,4,'Advanced charts','{\"m\":\"content\",\"t\":\"article\",\"p\":{\"alias\":\"advanced_charts\"}}','article','','2015-02-18 13:25:06','2015-02-18 22:21:44'),(81,3,4,'Custom Solution','{\"m\":\"content\",\"t\":\"article\",\"p\":{\"alias\":\"custom_solution\"}}','article','','2015-02-18 13:28:31','2015-02-18 22:20:22'),(84,20,2,'Broker Dealer Backoffice','{\"m\":\"content\",\"t\":\"article\",\"p\":{\"alias\":\"broker_dealer_backoffice\"}}','article','Broker Dealer Backoffice','2015-04-06 06:32:57','2015-05-13 16:40:13'),(82,53,1,'MQL4 and Algo Trading','{\"m\":\"content\",\"t\":\"article\",\"p\":{\"alias\":\"mql4_algo_trading\"}}','article','','2015-04-06 06:28:48','2015-05-18 14:46:03'),(83,53,2,'Multiple Account Management (MAM)','{\"m\":\"content\",\"t\":\"article\",\"p\":{\"alias\":\"multiple_account_management_mam\"}}','article','','2015-04-06 06:29:40','2015-05-18 15:03:44'),(53,20,0,'Desktop Trading Platform','{\"m\":\"content\",\"t\":\"category\",\"p\":{\"alias\":\"trading_platform\"}}','category','','2011-01-25 18:10:13','2015-04-06 16:40:02'),(77,53,3,'Customizable workplace','{\"m\":\"content\",\"t\":\"article\",\"p\":{\"alias\":\"customizable_workplace\"}}','article','','2015-02-18 13:24:39','2015-02-18 22:21:13'),(78,53,0,'Trading Functionality','{\"m\":\"content\",\"t\":\"article\",\"p\":{\"alias\":\"trading_functionality\"}}','article','','2015-02-18 13:24:52','2015-05-18 14:15:01'),(85,20,3,'Liquidity Aggregator','{\"m\":\"content\",\"t\":\"article\",\"p\":{\"alias\":\"liquidity_aggregator\"}}','article','','2015-04-06 06:33:09','2015-04-06 19:21:59'),(87,3,2,'FX and CFDs ECN Solution','{\"m\":\"content\",\"t\":\"article\",\"p\":{\"alias\":\"fx_and_cfds_ecn_solution\"}}','article','','2015-04-06 12:42:47','2015-05-13 17:03:55'),(88,3,3,'For Traders','{\"m\":\"content\",\"t\":\"article\",\"p\":{\"alias\":\"solution_for_traders\"}}','article','','2015-04-06 16:52:32','2015-04-06 20:52:32');
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modules`
--

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` VALUES (1,'*'),(2,'dbdiff'),(3,'accessmanager'),(4,'registration'),(5,'login'),(6,'indexpage'),(7,'content'),(8,'articlesmanager'),(9,'categoriesmanager'),(10,'profile'),(11,'menumanager'),(12,'admindashboard'),(13,'indexpagemanager'),(14,'sitemap'),(21,'search'),(17,'charts'),(18,'traders'),(19,'strategiesmanager'),(22,'Managed_Forex_Accounts'),(23,'feedbackmanager'),(24,'feedback'),(25,'Client_Area'),(26,'brokersmanager');
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opened_accs_confirms`
--

DROP TABLE IF EXISTS `opened_accs_confirms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opened_accs_confirms` (
  `user_id` int(11) NOT NULL,
  `broker_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`,`broker_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opened_accs_confirms`
--

LOCK TABLES `opened_accs_confirms` WRITE;
/*!40000 ALTER TABLE `opened_accs_confirms` DISABLE KEYS */;
INSERT INTO `opened_accs_confirms` VALUES (1,1,'2014-12-10 22:39:06'),(1,2,'2014-12-11 19:35:28');
/*!40000 ALTER TABLE `opened_accs_confirms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poa_uploads`
--

DROP TABLE IF EXISTS `poa_uploads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poa_uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `broker_id` int(11) NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `filecode` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poa_uploads`
--

LOCK TABLES `poa_uploads` WRITE;
/*!40000 ALTER TABLE `poa_uploads` DISABLE KEYS */;
INSERT INTO `poa_uploads` VALUES (2,1,1,'Erber 505375 source.csv','admin_5488ea38e846b.csv','2014-12-11 02:50:00'),(3,1,1,'AMB 25k.csv','admin_5488eab3cc116.csv','2014-12-11 02:52:03'),(4,1,1,'Apache.csv','admin_5488eabc9f7dd.csv','2014-12-11 02:52:12'),(5,1,1,'61268.trading.csv','admin_5488eb61d582f.csv','2014-12-11 02:54:57'),(6,1,1,'My little angels Source Data.csv','admin_5488ec3e22836.csv','2014-12-11 02:58:38'),(7,1,1,'Index 1 25k 1 Jan2014 - 4 nov 2014.csv','admin_5488ec5b6de70.csv','2014-12-11 02:59:07'),(8,1,1,'PCFX Logo no borders.png','admin_5488ec630b1c0.png','2014-12-11 02:59:15'),(9,1,2,'New Lexus master start - 4 Nov 2014.csv','admin_5489d5db4e468.csv','2014-12-11 19:35:23'),(10,1,2,'7729f24be5c780d3395e3b335f024cb3.jpg','admin_548b55b8b650b.jpg','2014-12-12 22:53:12');
/*!40000 ALTER TABLE `poa_uploads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roleaccess`
--

DROP TABLE IF EXISTS `roleaccess`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roleaccess` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `r` int(1) DEFAULT '0',
  `w` int(1) DEFAULT '0',
  `a` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `i_role_id` (`role_id`),
  KEY `i_module_id` (`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roleaccess`
--

LOCK TABLES `roleaccess` WRITE;
/*!40000 ALTER TABLE `roleaccess` DISABLE KEYS */;
INSERT INTO `roleaccess` VALUES (1,1,1,0,0,0),(2,2,1,1,1,1),(3,2,3,1,1,1),(4,2,2,1,1,1),(5,2,5,1,1,1),(6,2,4,1,1,1),(7,1,3,0,0,0),(8,1,2,0,0,0),(9,1,5,1,1,0),(10,1,4,1,1,0),(11,2,6,1,1,1),(12,1,6,1,0,0),(13,1,8,0,0,0),(14,1,9,0,0,0),(15,1,7,1,0,0),(16,1,11,0,0,0),(17,1,10,0,0,0),(18,1,12,0,0,0),(19,2,12,1,1,1),(20,2,8,1,1,1),(21,2,9,1,1,1),(22,2,7,1,1,1),(23,2,11,1,1,1),(24,2,10,1,1,1),(25,3,1,0,0,0),(26,3,3,0,0,0),(27,3,12,0,0,0),(28,3,8,0,0,0),(29,3,9,0,0,0),(30,3,7,1,0,0),(31,3,2,0,0,0),(32,3,6,1,1,0),(33,3,5,1,1,0),(34,3,11,0,0,0),(35,3,10,1,1,0),(36,3,4,1,1,0),(37,1,13,0,0,0),(38,1,15,0,0,0),(39,1,14,0,0,0),(40,2,13,1,1,1),(41,2,15,0,0,0),(42,2,14,1,1,1),(43,3,13,0,0,0),(44,3,14,0,0,0),(57,1,22,1,1,0),(58,1,21,1,1,0),(47,1,17,1,0,0),(48,1,18,1,1,0),(49,3,17,1,1,0),(50,3,18,1,1,0),(51,2,17,1,1,1),(59,3,22,1,1,0),(53,2,18,1,1,1),(54,2,19,1,1,1),(55,1,19,0,0,0),(56,1,20,0,0,0),(60,3,21,1,1,0),(61,3,19,0,0,0),(62,2,22,1,1,1),(63,2,21,1,1,1),(64,1,24,1,1,0),(65,1,23,0,0,0),(66,2,24,1,1,1),(67,2,23,1,1,1),(68,3,24,1,1,0),(69,3,23,0,0,0),(70,3,25,1,1,0),(71,2,25,1,1,1),(72,3,26,0,0,0),(73,2,26,1,1,1);
/*!40000 ALTER TABLE `roleaccess` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Guest'),(2,'Admin'),(3,'Registered');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ru_articles`
--

DROP TABLE IF EXISTS `ru_articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ru_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) DEFAULT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `alias` varchar(1000) DEFAULT NULL,
  `preview` text,
  `content` longtext,
  `create_date` datetime DEFAULT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_title` varchar(1000) DEFAULT NULL,
  `meta_keywords` varchar(2000) DEFAULT NULL,
  `meta_description` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `i_cat_id` (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ru_articles`
--

LOCK TABLES `ru_articles` WRITE;
/*!40000 ALTER TABLE `ru_articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `ru_articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ru_categories`
--

DROP TABLE IF EXISTS `ru_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ru_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(1000) NOT NULL,
  `alias` varchar(1000) NOT NULL,
  `description` text,
  `create_date` datetime DEFAULT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_title` varchar(1000) DEFAULT NULL,
  `meta_keywords` varchar(2000) DEFAULT NULL,
  `meta_description` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ru_categories`
--

LOCK TABLES `ru_categories` WRITE;
/*!40000 ALTER TABLE `ru_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `ru_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ru_menu_items`
--

DROP TABLE IF EXISTS `ru_menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ru_menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `title` varchar(1000) DEFAULT NULL,
  `link` varchar(1000) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `desc` varchar(1000) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ru_menu_items`
--

LOCK TABLES `ru_menu_items` WRITE;
/*!40000 ALTER TABLE `ru_menu_items` DISABLE KEYS */;
INSERT INTO `ru_menu_items` VALUES (1,0,0,'Top Menu','','menu','','2014-10-03 20:40:06','2014-10-03 17:40:06');
/*!40000 ALTER TABLE `ru_menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ru_staticpages`
--

DROP TABLE IF EXISTS `ru_staticpages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ru_staticpages` (
  `page` varchar(11) NOT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `content` longtext,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_title` varchar(1000) DEFAULT NULL,
  `meta_keywords` varchar(2000) DEFAULT NULL,
  `meta_description` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ru_staticpages`
--

LOCK TABLES `ru_staticpages` WRITE;
/*!40000 ALTER TABLE `ru_staticpages` DISABLE KEYS */;
INSERT INTO `ru_staticpages` VALUES ('indexpage','TradeMUX','','2015-05-18 23:05:15','','',''),('traders','ÐÐ°ÑˆÐ¸ Ñ‚Ñ€ÐµÐ¹Ð´ÐµÑ€Ñ‹','Ð—Ð´ÐµÑÑŒ Ð´Ð¾Ð»Ð¶Ð½Ð¾ Ð±Ñ‹Ñ‚ÑŒ Ð¾Ð¿Ð¸ÑÐ°Ð½Ð¸Ðµ Ñ‚Ñ€ÐµÐ¹Ð´ÐµÑ€Ð¾Ð² Ð¸ Ð²ÑÑ‘ Ñ‚Ð°ÐºÐ¾Ðµ ...','2014-10-17 18:25:54','','','');
/*!40000 ALTER TABLE `ru_staticpages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staticpages`
--

DROP TABLE IF EXISTS `staticpages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staticpages` (
  `page` varchar(11) NOT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `content` longtext,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_title` varchar(1000) DEFAULT NULL,
  `meta_keywords` varchar(2000) DEFAULT NULL,
  `meta_description` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staticpages`
--

LOCK TABLES `staticpages` WRITE;
/*!40000 ALTER TABLE `staticpages` DISABLE KEYS */;
INSERT INTO `staticpages` VALUES ('indexpage','TradeMUX','<div id=\"rt-features\">\r\n	<div class=\"rt-container\">\r\n		<div class=\"rt-grid-6 rt-alpha\">\r\n			<div class=\"module1\">\r\n				<div class=\"rt-badge\">\r\n					&nbsp;</div>\r\n				<div class=\"rt-block\">\r\n					<div class=\"rt-block1\">\r\n						<div style=\"text-align: justify;\">\r\n							<h1 class=\"title\">\r\n								<strong>FOREX and CFDs online trading and&nbsp; brokerage software</strong></h1>\r\n							<hr />\r\n							TradeMUX is <strong>trading and brokerage software for FOREX and CFDs markets</strong>. TradeMUX consists of: <a href=\"http://trademux.net/trading_platform/\">desktop FX and CFDs trading platform</a>, <a href=\"http://trademux.net/trading_server_for_forex_and_cfds_trading.html\">trading server (ems, oms, ticker plants, matching engine)</a>, <a href=\"http://trademux.net/liquidity_aggregator.html\">liquidity aggregation software</a>, <a href=\"http://trademux.net/stp_bridge.html\">stp bridge </a>and <a href=\"http://trademux.net/broker_dealer_backoffice.html\">broker dealer backoffice</a>.<br />\r\n							<br />\r\n							<strong> TradeMUX was built to make trading more efficient. </strong>The<strong>&nbsp;</strong>Ultra Low-latency trading server provides &nbsp;<strong>microsecond execution speed.</strong> STP bridges allow <strong>parallel access to multiple liquidity providers</strong>. The liquidity aggregator gives better spreads and deeper liquidity.<br />\r\n							&nbsp;</div>\r\n						<div class=\"module-content\">\r\n							<div class=\"custommodule1\">\r\n								<div style=\"text-align: justify;\">\r\n									<strong>TradeMUX is MQL4 Compatible</strong> and has tools to quickly automate trading strategies. <strong>MQL4 with fast execution</strong>&nbsp;works much more profitably for scalpers, news traders and High Frequency Trading (HFT) strategies.<br />\r\n									&nbsp;</div>\r\n								<div style=\"text-align: justify;\">\r\n									<strong>Other useful features:</strong> &nbsp;tick charts, charts overlay, custom time frame charts, one click trading, trading from charts, bulk order management, multiple account management (MAM), customizable workplace.</div>\r\n								<div class=\"clear\">\r\n									&nbsp;</div>\r\n							</div>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n		<div class=\"rt-grid-6 rt-omega\">\r\n			<div class=\"rt-block\">\r\n				<div class=\"rt-block1\">\r\n					<div class=\"module-content\">\r\n						<div class=\"custom\">\r\n							<div class=\"avPlayerWrapper\">\r\n								<div class=\"avPlayerContainer\" style=\"width:434px;\">\r\n									<div class=\"avPlayerBlock\">\r\n										<iframe frameborder=\"0\" height=\"250\" src=\"http://player.vimeo.com/video/124352067?portrait=0\" title=\"Enjoy trading\" width=\"434\"></iframe></div>\r\n								</div>\r\n							</div>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n		<div class=\"clear\">\r\n			&nbsp;</div>\r\n	</div>\r\n</div>\r\n<div id=\"rt-utility\">\r\n	<div class=\"rt-container\">\r\n		<div class=\"gkTab\" id=\"gkTab-268\">\r\n			<div class=\"gkTabWrap\">\r\n				<ul class=\"gkTabs top\">\r\n					<li class=\"gkTab-1 active\">\r\n						<span>Desktop Trading Platform</span></li>\r\n					<li class=\"gkTab-2\">\r\n						<span>Trading server</span></li>\r\n					<li class=\"gkTab-3\">\r\n						<span>Backoffice</span></li>\r\n					<li class=\"gkTab-4\">\r\n						<span>STP Bridge</span></li>\r\n					<li class=\"gkTab-5\">\r\n						<span>Liquidity aggregator</span></li>\r\n				</ul>\r\n				<div class=\"gkTabContainer0\" style=\"width: 960px;\">\r\n					<div class=\"gkTabContainer1\">\r\n						<div class=\"gkTabContainer2\" style=\"width: 4800px;\">\r\n							<div class=\"gkTabItem active\" style=\"position: absolute; left: 0px; width: 960px;\">\r\n								<div class=\"gkTabItemSpace\">\r\n									<img class=\"image-left image-middle\" src=\"/images/pages/platform.png\" />\r\n									<h3>\r\n										TradeMUX Desktop is low-latency trading platform with powerful functionality.</h3>\r\n									<strong>Amonth the long list of feature are:</strong>\r\n									<div style=\"margin-left: 520px\">\r\n										<ul class=\"list-arrowright\" style=\"margin-bottom:15px\">\r\n											<li>\r\n												Low latency execution measured in microseconds.<br />\r\n												Fast execution allows you to capture best price earlier than competitors and drastically reduce slippage</li>\r\n											<li>\r\n												Trade with many Liquidity Providers from a single trading terminal</li>\r\n											<li>\r\n												MQL4 compatible and allows easy algo development</li>\r\n											<li>\r\n												Multiple account management (MAM)</li>\r\n											<li>\r\n												One click trading and trading from charts</li>\r\n											<li>\r\n												Supports multiple languages</li>\r\n										</ul>\r\n										<a class=\"button-small\" href=\"/trading_platform\">FX and CFDs trading platform</a></div>\r\n								</div>\r\n							</div>\r\n							<div class=\"gkTabItem\" style=\"position: absolute; left: 960px; width: 960px;\">\r\n								<div class=\"gkTabItemSpace\">\r\n									<strong><img class=\"image-left image-middle\" src=\"/images/pages/server.png\" /> </strong>\r\n									<h3>\r\n										TradeMUX Server is high performance brokerage solution consisting of:</h3>\r\n									<div style=\"margin-left: 520px\">\r\n										<ul class=\"list-arrowright\" style=\"margin-bottom:15px\">\r\n											<li>\r\n												Bridges to liquidity providers</li>\r\n											<li>\r\n												Smart order routing engine</li>\r\n											<li>\r\n												Order matching engine</li>\r\n											<li>\r\n												Ticker plants</li>\r\n											<li>\r\n												Risk management server</li>\r\n											<li>\r\n												History database and reporting server</li>\r\n											<li>\r\n												Liquidity aggregation and self clearing tools</li>\r\n										</ul>\r\n										<a class=\"button-small\" href=\"/trading_server_for_forex_and_cfds_trading.html\">FX and CFDs trading server</a></div>\r\n								</div>\r\n							</div>\r\n							<div class=\"gkTabItem\" style=\"position: absolute; left: 1920px; width: 960px;\">\r\n								<div class=\"gkTabItemSpace\">\r\n									<strong><img class=\"image-left image-middle\" src=\"/images/pages/backoffice.png\" /> </strong>\r\n									<h3>\r\n										TradeMUX Backoffice is a comprehensive management and administrative tool tailored to your business processes.</h3>\r\n									<div style=\"margin-left: 520px\">\r\n										<ul class=\"list-arrowright\" style=\"margin-bottom:15px\">\r\n											<li>\r\n												Users and accounts management</li>\r\n											<li>\r\n												Hierarchical user structure and customizable access permissions</li>\r\n											<li>\r\n												Liquidity provider and price streams management</li>\r\n											<li>\r\n												Manage Trading Sessions</li>\r\n											<li>\r\n												Markup, commission and swap management</li>\r\n											<li>\r\n												Real-Time Exposure control; Position and order management</li>\r\n											<li>\r\n												Position and order management</li>\r\n											<li>\r\n												Reporting tools</li>\r\n											<li>\r\n												Allows backoffice access to IBs</li>\r\n										</ul>\r\n										<a class=\"button-small\" href=\"/broker_dealer_backoffice.html\">FX and CFDs broker dealer backoffice</a></div>\r\n								</div>\r\n							</div>\r\n							<div class=\"gkTabItem\" style=\"position: absolute; left: 2880px; width: 960px;\">\r\n								<div class=\"gkTabItemSpace\">\r\n									<strong><img class=\"image-left image-middle\" src=\"/images/pages/bridge.png\" /> </strong>\r\n									<h3>\r\n										The TradeMUX STP Bridge supports complex order routing and allows the broker to implement a Straight Through Processing (STP) business model.</h3>\r\n									<div style=\"margin-left: 520px\">\r\n										<ul class=\"list-arrowright\" style=\"margin-bottom:15px\">\r\n											<li>\r\n												Limit Orders support (GTC, IOC, FOK); Partial fills support</li>\r\n											<li>\r\n												Ultra-low latency and fast execution</li>\r\n											<li>\r\n												Parallel connectivity to multiple liquidity providers</li>\r\n											<li>\r\n												Multi-Asset covering FX, CFDs, Indices</li>\r\n											<li>\r\n												Complex and dynamic order routing rules</li>\r\n											<li>\r\n												Switch your clients between Books without restarting server and changing instrument name</li>\r\n										</ul>\r\n										<a class=\"button-small\" href=\"/stp_bridge.html\">FOREX and CFDs bridge</a></div>\r\n								</div>\r\n							</div>\r\n							<div class=\"gkTabItem\" style=\"position: absolute; left: 3840px; width: 960px;\">\r\n								<div class=\"gkTabItemSpace\">\r\n									<strong><img class=\"image-left image-middle\" src=\"/images/pages/aggregator.png\" /> </strong>\r\n									<h3>\r\n										Liquidity aggregator enables users to aggregate liquidity from several liquidity providers.</h3>\r\n									<strong>The Liquidity Aggregator provides two main functions:</strong>\r\n									<div style=\"margin-left: 520px\">\r\n										<ul class=\"list-arrowright\" style=\"margin-bottom:15px\">\r\n											<li>\r\n												It allows traders to compare price from different liquidity venues such as banks, global market makers, or ECNs like Currenex, FXall or Hotspot FX. This allows traders to trade with many participants using a single trading terminal.</li>\r\n											<li>\r\n												It allows price feed aggregation from several providers into a single price stream thus delivering the best execution prices available and reduces the risk of having poor liquidity during volatile market periods.</li>\r\n										</ul>\r\n										<a class=\"button-small\" href=\"/liquidity_aggregator.html\">FX and CFDs liquidity aggregator</a></div>\r\n								</div>\r\n							</div>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n		<div class=\"clear\">\r\n			<strong>&nbsp;</strong></div>\r\n	</div>\r\n</div>\r\n','2015-08-21 08:00:51','brokerage software for Forex, CFDs brokers and dealers','forex broker software, forex brokerage software, forex brokerage solution, cfds broker software, cfds brokerage software, cfds brokerage solution','TradeMUX Online Trading and Brokerage Software for FOREX, FX, CFDs broker dealer business'),('traders','Our Traders','<p style=\"text-align: justify;\">\r\n	Have a look at these carefully selected managers. All can easily manage your forex account. We have put extensive resources into discovering each of them and are making them available to you. All the forex traders shown below were selected using our <a href=\"http://beta.profitcenterfx.com/trader_s_selection_system.html\" target=\"_blank\">very strict trader&#39;s selection system</a> . We are certain the trading results of these managers form consistent patterns and are not gambling.&nbsp; We detail how we select our traders on <a href=\"http://beta.profitcenterfx.com/trader_s_selection_system.html\" target=\"_blank\">this page</a>. Here are some short facts about our traders:</p>\r\n<strong>1) They show more than 9 month profitable trading on verified real accounts with reputable brokers<br />\r\n2) Low volatility with upward sloping equity curves<br />\r\n3) No martingale or grid systems<br />\r\n4) Very strict risk control on our side with equity hard stop </strong>','2014-12-01 17:40:19','','','');
/*!40000 ALTER TABLE `staticpages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `strategies`
--

DROP TABLE IF EXISTS `strategies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `strategies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `startdate` datetime DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `short_desc` varchar(1000) DEFAULT NULL,
  `desc` text,
  `ru_short_desc` varchar(1000) DEFAULT NULL,
  `ru_desc` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `strategies`
--

LOCK TABLES `strategies` WRITE;
/*!40000 ALTER TABLE `strategies` DISABLE KEYS */;
/*!40000 ALTER TABLE `strategies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `useraccess`
--

DROP TABLE IF EXISTS `useraccess`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `useraccess` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `r` int(1) DEFAULT '0',
  `w` int(1) DEFAULT '0',
  `a` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `i_user_id` (`user_id`),
  KEY `i_module_id` (`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `useraccess`
--

LOCK TABLES `useraccess` WRITE;
/*!40000 ALTER TABLE `useraccess` DISABLE KEYS */;
INSERT INTO `useraccess` VALUES (36,6,4,0,0,0),(35,6,10,0,0,0),(34,6,11,0,0,0),(33,6,5,0,0,0),(32,6,6,0,0,0),(31,6,2,0,0,0),(30,6,7,0,0,0),(29,6,9,0,0,0),(28,6,8,0,0,0),(27,6,12,0,0,0),(26,6,3,0,0,0),(25,6,1,0,0,0),(13,1,1,0,0,0),(14,1,3,0,0,0),(15,1,12,0,0,0),(16,1,8,0,0,0),(17,1,9,0,0,0),(18,1,7,0,0,0),(19,1,2,0,0,0),(20,1,6,0,0,0),(21,1,5,0,0,0),(22,1,11,0,0,0),(23,1,10,0,0,0),(24,1,4,0,0,0),(37,1,17,0,0,0),(38,1,13,0,0,0),(40,1,14,0,0,0),(41,1,18,0,0,0),(42,6,17,0,0,0),(43,6,13,0,0,0),(45,6,14,0,0,0),(46,6,18,0,0,0),(47,15,1,0,0,0),(48,15,3,0,0,0),(49,15,12,0,0,0),(50,15,8,0,0,0),(51,15,26,0,0,0),(52,15,9,0,0,0),(53,15,17,0,0,0),(54,15,25,0,0,0),(55,15,7,0,0,0),(56,15,2,0,0,0),(57,15,24,0,0,0),(58,15,23,0,0,0),(59,15,6,0,0,0),(60,15,13,0,0,0),(61,15,5,0,0,0),(62,15,22,0,0,0),(63,15,11,0,0,0),(64,15,10,0,0,0),(65,15,4,0,0,0),(66,15,21,0,0,0),(67,15,14,0,0,0),(68,15,19,0,0,0),(69,15,18,0,0,0),(70,1,26,0,0,0),(71,1,25,0,0,0),(72,1,24,0,0,0),(73,1,23,0,0,0),(74,1,22,0,0,0),(75,1,21,0,0,0),(76,1,19,0,0,0);
/*!40000 ALTER TABLE `useraccess` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `name` varchar(500) DEFAULT NULL,
  `lastname` varchar(500) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date_add` datetime DEFAULT NULL,
  `date_last_modify` datetime DEFAULT NULL,
  `date_last_login` datetime DEFAULT NULL,
  `code` varchar(32) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  `lang` varchar(2) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `acc_type` varchar(10) DEFAULT NULL,
  `trust_type` varchar(10) DEFAULT NULL,
  `company` varchar(500) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `broker_id` int(11) DEFAULT NULL,
  `sign` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `i_role_id` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,2,'admin','1bbd886460827015e5d605ed44252251','','Admin',NULL,'','2010-11-25 18:09:32','2015-10-14 11:06:41','2017-11-28 15:49:37',NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_accounts`
--

DROP TABLE IF EXISTS `users_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `strategy_id` int(11) NOT NULL,
  `account` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_accounts`
--

LOCK TABLES `users_accounts` WRITE;
/*!40000 ALTER TABLE `users_accounts` DISABLE KEYS */;
INSERT INTO `users_accounts` VALUES (1,1,14,'1234567890'),(2,1,13,'1234567889');
/*!40000 ALTER TABLE `users_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_strategies`
--

DROP TABLE IF EXISTS `users_strategies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_strategies` (
  `user_id` int(11) NOT NULL,
  `strategy_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`strategy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_strategies`
--

LOCK TABLES `users_strategies` WRITE;
/*!40000 ALTER TABLE `users_strategies` DISABLE KEYS */;
INSERT INTO `users_strategies` VALUES (1,12),(2,12),(2,13),(3,12),(3,13);
/*!40000 ALTER TABLE `users_strategies` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-28 16:23:55
