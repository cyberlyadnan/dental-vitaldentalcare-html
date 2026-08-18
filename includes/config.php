<?php
// Vital Dental Care — central configuration
// Environment-sensitive values live here. Move to .env when a backend is introduced.

const SITE_NAME        = 'Vital Dental Care';
const SITE_TAGLINE     = 'Advanced Dentistry. Personal Care. Confident Smiles.';
const SITE_URL         = 'https://www.vitaldentalcare.co.in';

const PRIMARY_PHONE    = '+91 880 090 1692';
const PRIMARY_PHONE_TEL= '+918800901692';
const SECONDARY_PHONE  = '+91 800 750 1892';
const SECONDARY_PHONE_TEL = '+918007501892';

const WHATSAPP_NUMBER  = '918800901692';
const EMAIL            = 'info@vitaldentalcare.co.in';

const HOURS            = 'Mon–Sun · 9:00 AM – 9:00 PM';

// Global defaults for SEO helper
const DEFAULT_OG_IMAGE = '/assets/images/og/og-default.svg';
const PRIMARY_COLOR    = '#0B2545';
const ACCENT_COLOR     = '#1F8A8A';

// Build version for cache busting
const ASSET_VERSION    = '2.9.0';

// Enables future PHP appointment handler. False keeps the form frontend-only.
const APPOINTMENT_HANDLER_ENABLED = false;
