<?php

declare(strict_types=1);

namespace ModularityContactCard\Module;

use WP_Post;

class ContactCard extends \Modularity\Module
{
    public $slug = 'contact-card';
    public $supports = [];
    public $isBlockCompatible = true;
    public $expectsTitleField = false;

    public function init(): void
    {
        $this->nameSingular = __('Kontaktkort', 'modularity-contact-card');
        $this->namePlural = __('Kontaktkort', 'modularity-contact-card');
        $this->description = __(
            'Visar ett valt kontaktkort med titel och brödtext.',
            'modularity-contact-card',
        );
    }

    public function data(): array
    {
        $fields = $this->getFields();
        $contact = $this->normalizeContact($fields['contact_card'] ?? 0);
        $color = $this->normalizeColor($fields['background_color'] ?? 'red');
        $panelTitle = $this->normalizePanelTitle($fields['panel_title'] ?? __('Kontakt', 'modularity-contact-card'));

        return [
            'contact' => $contact,
            'color' => $color,
            'panelTitle' => $panelTitle,
        ];
    }

    public function template(): string
    {
        return 'contact-card.blade.php';
    }

    /**
     * @param mixed $contactId
     * @return array{preamble:string,content:string}|null
     */
    private function normalizeContact($contactId): ?array
    {
        $contactId = absint($contactId);
        if ($contactId < 1) {
            return null;
        }

        $contactPost = get_post($contactId);
        if (!$contactPost instanceof WP_Post || $contactPost->post_type !== 'kontaktkort' || $contactPost->post_status !== 'publish') {
            return null;
        }

        $title = trim(wp_strip_all_tags(get_the_title($contactPost)));
        $content = (string) apply_filters('the_content', $contactPost->post_content);

        if ($title === '' && trim(wp_strip_all_tags($content)) === '') {
            return null;
        }

        return [
            'preamble' => $title,
            'content' => $content,
        ];
    }

    /**
     * @param mixed $color
     */
    private function normalizeColor($color): string
    {
        $allowedColors = [
            'blue',
            'green',
            'orange',
            'purple',
            'red',
            'teal',
            'yellow',
        ];

        $color = is_string($color) ? strtolower(trim($color)) : '';

        if (!in_array($color, $allowedColors, true)) {
            return 'red';
        }

        return $color;
    }

    /**
     * @param mixed $panelTitle
     */
    private function normalizePanelTitle($panelTitle): string
    {
        $panelTitle = is_string($panelTitle) ? trim($panelTitle) : '';

        return $panelTitle !== '' ? $panelTitle : __('Kontakt', 'modularity-contact-card');
    }
}
