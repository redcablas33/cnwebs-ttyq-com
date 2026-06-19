<?php

/**
 * Class LinkCard
 * 
 * Renders an HTML link card for displaying website previews.
 * Uses basic PHP string operations and htmlspecialchars for safe output.
 */
class LinkCard
{
    /**
     * Default card configuration.
     *
     * @var array
     */
    private $config = [
        'url'          => 'https://cnwebs-ttyq.com',
        'title'        => '天天盈球',
        'description'  => '体育赛事资讯与数据分析平台',
        'favicon_url'  => '',
        'image_url'    => '',
        'target'       => '_blank',
        'css_class'    => 'link-card',
    ];

    /**
     * Constructor accepts optional override array.
     *
     * @param array $options Key-value pairs to override defaults.
     */
    public function __construct(array $options = [])
    {
        foreach ($options as $key => $value) {
            if (array_key_exists($key, $this->config)) {
                $this->config[$key] = $value;
            }
        }
    }

    /**
     * Set a single configuration value.
     *
     * @param string $key
     * @param mixed  $value
     * @return void
     */
    public function set(string $key, $value): void
    {
        if (array_key_exists($key, $this->config)) {
            $this->config[$key] = $value;
        }
    }

    /**
     * Render the full link card HTML block.
     *
     * @return string Escaped HTML string.
     */
    public function render(): string
    {
        $url         = $this->escape($this->config['url']);
        $title       = $this->escape($this->config['title']);
        $description = $this->escape($this->config['description']);
        $favicon     = $this->escape($this->config['favicon_url']);
        $image       = $this->escape($this->config['image_url']);
        $target      = $this->escape($this->config['target']);
        $cssClass    = $this->escape($this->config['css_class']);

        $faviconHtml = '';
        if ($favicon !== '') {
            $faviconHtml = '<img src="' . $favicon . '" alt="icon" class="link-card-favicon" />';
        }

        $imageHtml = '';
        if ($image !== '') {
            $imageHtml = '<img src="' . $image . '" alt="preview" class="link-card-image" />';
        }

        $html = '<div class="' . $cssClass . '">' . "\n";
        $html .= '    <a href="' . $url . '" target="' . $target . '" rel="noopener noreferrer" class="link-card-link">' . "\n";
        $html .= '        ' . $imageHtml . "\n";
        $html .= '        <div class="link-card-body">' . "\n";
        $html .= '            <span class="link-card-title">' . $title . '</span>' . "\n";
        $html .= '            <span class="link-card-description">' . $description . '</span>' . "\n";
        $html .= '            ' . $faviconHtml . "\n";
        $html .= '        </div>' . "\n";
        $html .= '    </a>' . "\n";
        $html .= '</div>' . "\n";

        return $html;
    }

    /**
     * Render only the inner anchor and body (without wrapper div).
     *
     * @return string Escaped HTML string.
     */
    public function renderInline(): string
    {
        $url         = $this->escape($this->config['url']);
        $title       = $this->escape($this->config['title']);
        $description = $this->escape($this->config['description']);
        $favicon     = $this->escape($this->config['favicon_url']);
        $image       = $this->escape($this->config['image_url']);
        $target      = $this->escape($this->config['target']);

        $faviconHtml = '';
        if ($favicon !== '') {
            $faviconHtml = '<img src="' . $favicon . '" alt="icon" class="link-card-favicon" />';
        }

        $imageHtml = '';
        if ($image !== '') {
            $imageHtml = '<img src="' . $image . '" alt="preview" class="link-card-image" />';
        }

        $html = '<a href="' . $url . '" target="' . $target . '" rel="noopener noreferrer" class="link-card-link">' . "\n";
        $html .= '    ' . $imageHtml . "\n";
        $html .= '    <div class="link-card-body">' . "\n";
        $html .= '        <span class="link-card-title">' . $title . '</span>' . "\n";
        $html .= '        <span class="link-card-description">' . $description . '</span>' . "\n";
        $html .= '        ' . $faviconHtml . "\n";
        $html .= '    </div>' . "\n";
        $html .= '</a>' . "\n";

        return $html;
    }

    /**
     * Simple helper to escape HTML special characters.
     *
     * @param string $value
     * @return string
     */
    private function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    /**
     * Static factory: create and render in one call.
     *
     * @param array $options
     * @return string
     */
    public static function createAndRender(array $options = []): string
    {
        $card = new self($options);
        return $card->render();
    }
}

// --- Example usage (can be removed or kept as demo) ---
/*
$card = new LinkCard();
echo $card->render();

$customCard = new LinkCard([
    'url'         => 'https://cnwebs-ttyq.com',
    'title'       => '天天盈球',
    'description' => '专业体育数据服务',
    'favicon_url' => 'https://example.com/favicon.ico',
    'image_url'   => 'https://example.com/preview.jpg',
    'target'      => '_self',
    'css_class'   => 'custom-link-card',
]);
echo $customCard->renderInline();
*/