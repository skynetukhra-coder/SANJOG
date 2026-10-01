-- =====================================================================
-- SANJOG Modernization: Phase 4 Database Index & Optimization Patch
-- Target Database: agwb (MySQL 8.0+)
-- Description: Adds high-performance indexes to eliminate full table
-- scans across high-volume Pension, CMS, Menu, DDO, and Subscriber tables.
-- =====================================================================

-- 1. Pension Tables (255k rows)
-- Optimizes get_pension_details, get_pension_return_details, get_pension_dispatched_details
ALTER TABLE `agb_pension` ADD KEY IF NOT EXISTS `idx_pension_apa_appln_pk` (`apa_appln_pk`);
ALTER TABLE `agb_pension_case` ADD KEY IF NOT EXISTS `idx_pension_case_appln_pk` (`appln_pk`);

-- 2. DDO Master (13.3k rows)
-- Optimizes DDO login, profile lookup, and subscriber-DDO mapping joins
ALTER TABLE `agb_ddo_master` ADD UNIQUE KEY IF NOT EXISTS `idx_ddo_cd` (`ddo_cd`);

-- 3. CMS Dynamic Pages & Multilingual Content
-- Optimizes getPageByURL and getFooterPageByURL on every CMS page request
ALTER TABLE `agb_page` ADD KEY IF NOT EXISTS `idx_page_url_office` (`page_url`, `page_office_code`);
ALTER TABLE `agb_page_details` ADD KEY IF NOT EXISTS `idx_page_lang` (`page_id`, `language_id`);
ALTER TABLE `agb_page_common_cms` ADD KEY IF NOT EXISTS `idx_page_url` (`page_url`);
ALTER TABLE `agb_page_details_common_cms` ADD KEY IF NOT EXISTS `idx_page_lang` (`page_id`, `language_id`);

-- 4. Dynamic Navigation Menus
-- Optimizes header menu queries (getOfficeMenu, getTenderNoticeMenu, getContactUsMenu) executed on every HTTP request
ALTER TABLE `agb_menu` ADD KEY IF NOT EXISTS `idx_menu_office` (`office_code`, `status`);
ALTER TABLE `agb_menu_details` ADD KEY IF NOT EXISTS `idx_menu_lang` (`menu_id`, `language_id`);
ALTER TABLE `agb_office_menu` ADD KEY IF NOT EXISTS `idx_office_menu_lookup` (`office_code`, `status`, `sort`);
ALTER TABLE `agb_office_menu_details` ADD KEY IF NOT EXISTS `idx_office_menu_lang` (`office_menu_id`, `language_id`);

-- 5. Subscriber Master
-- Optimizes DDO subscriber listings and mapping queries
ALTER TABLE `agb_subscriber_master` ADD KEY IF NOT EXISTS `idx_subs_cur_ddo` (`cur_ddo`);

-- 6. Grievance & Complaint Tracking
-- Optimizes complaint resolution and vendor in/out joins
ALTER TABLE `agb_comp_inout_records` ADD KEY IF NOT EXISTS `idx_compt_no` (`compt_no`);

-- 7. Session Persistence
-- Optimizes CodeIgniter database session lookups and garbage collection
ALTER TABLE `agb_sessions` ADD PRIMARY KEY IF NOT EXISTS (`id`);
ALTER TABLE `agb_sessions` ADD KEY IF NOT EXISTS `agb_sessions_timestamp` (`timestamp`);
