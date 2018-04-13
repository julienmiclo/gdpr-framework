<?php

namespace Codelight\GDPR\Components\PrivacyToolsPage;

class PrivacyToolsPageShortcode
{
    public function __construct(PrivacyToolsPageController $controller)
    {
        $this->controller = $controller;

        add_shortcode('gdpr_privacy_tools', [$this, 'renderPage']);
        add_shortcode('gdpr_privacy_tools_url', [$this, 'renderUrlShortcode']);
        add_shortcode('gdpr_privacy_tools_link', [$this, 'renderLinkShortcode']);
    }

    public function renderPage()
    {
        if (!gdpr('options')->get('enable')) {
            return __('This page is currently disabled.', 'gdpr');
        }

        ob_start();
        $this->controller->render();
        return ob_get_clean();
    }

    public function renderUrlShortcode()
    {
        return gdpr('helpers')->getPrivacyToolsPageUrl();
    }

    public function renderLinkShortcode($attributes)
    {
        $attributes = shortcode_atts([
            'title' => __('Privacy Tools', 'gdpr'),
        ], $attributes);

        $url = gdpr('helpers')->getPrivacyToolsPageUrl();

        return
            "<a href='{$url}'>" .
            esc_html($attributes['title']) .
            "</a>";
    }
}