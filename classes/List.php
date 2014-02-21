<?php

/**
 * Object representing an article list.
 *
 * @package Arlima
 * @since 1.0
 */
class Arlima_List
{

    const STATUS_PREVIEW = 2;
    const STATUS_PUBLISHED = 1;
    const STATUS_EMPTY = -1; // the status it will have when its created and no version yet exists
    const QUERY_ARG_PREVIEW = 'arlima-preview';

    /**
     * @var bool|array
     */
    private $post_ids = false;

    /**
     * @var int
     */
    private $id = 0;

    /**
     * @var int
     */
    private $created = 0;

    /**
     * @var string
     */
    private $title = '';

    /**
     * @var string
     */
    private $slug = '';

    /**
     * @var int
     */
    private $status = self::STATUS_EMPTY;

    /**
     * @var array
     */
    private $version = array('id' => 0, 'created'=>0, 'user_id'=>0);

    /**
     * @var int
     */
    private $maxlength = 50;

    /**
     * @var array
     */
    private $versions = array();

    /**
     * Tells us whether or not this is a list imported from a remote server
     * @var bool
     */
    private $is_imported = false;

    /**
     * This is variable is public for backwards compatibility reasons
     * @var array
     */
    public $options = array(
        'template' => 'article',
        'pages_to_purge' => '',
        'supports_sections' => "0", // translates to bool false
        'allows_template_switching' => "1",
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    );

    /**
     * @var array
     */
    private $articles = array();

    /**
     * @var bool
     */
    private $exists = false;

    /**
     * @param bool $exists
     * @param int $id
     * @param bool $is_imported
     */
    function __construct($exists = false, $id = 0, $is_imported = false)
    {
        $this->exists = $exists;
        $this->is_imported = $is_imported;
        $this->id = $id;
    }

    /**
     * Tells whether or not this arlima list exists in the database
     * @return bool
     */
    public function exists()
    {
        return $this->exists;
    }

    /**
     * Tells whether or not this arlima list is loaded from
     * a remote host
     * @return bool
     */
    public function isImported()
    {
        return $this->is_imported;
    }

    /**
     * Tells whether or not this is a preview version
     * @return bool
     */
    public function isPreview()
    {
        return $this->getStatus() == self::STATUS_PREVIEW;
    }

    /**
     * Whether or not admins can create "sections" in the list
     * @return bool
     */
    public function isSupportingSections()
    {
        return !empty($this->options['supports_sections']);
    }

    /**
     * Whether or not editors is allowed to switch template
     * on specific articles in the list
     * @return bool
     */
    public function isSupportingEditorTemplateSwitch()
    {
        return $this->getOption('allows_template_switching') === null || $this->getOption('allows_template_switching');
    }

    /**
     * Returns information about this version of the list
     * @see Arlima_List::getVersionAttribute()
     * @return array
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $name Either 'user_id', 'created' or 'id'
     * @return string
     */
    public function getVersionAttribute($name)
    {
        return isset($this->version[$name]) ? $this->version[$name] : null;
    }

    /**
     * A list with the latest created versions of this list
     * @return array
     */
    public function getVersions()
    {
        return $this->versions;
    }

    /**
     * @param array $versions
     */
    public function setVersions($versions)
    {
        $this->versions = $versions;
    }

    /**
     * @param array $version_data
     */
    public function setVersion($version_data)
    {
        $this->version = $version_data;
    }

    /**
     * @param $name
     * @return string|null
     */
    public function getOption($name)
    {
        return isset($this->options[$name]) ? $this->options[$name] : null;
    }

    /**
     * @param string $name
     * @param string $val
     */
    public function setOption($name, $val)
    {
        $this->options[$name] = $val;
    }

    /**
     * @return int
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Returns a list with id numbers of the posts that has a connection
     * to one or more articles in this list
     * @return array
     */
    public function getContainingPosts()
    {
        if( $this->post_ids === false ) {
            $this->post_ids = array();
            foreach($this->getArticles() as $article) {
                if( !empty($article['post']) ) {
                    $this->post_ids[] = $article['post'];
                }
                foreach ($article['children'] as $child) {
                    if (!empty($child['post'])) {
                        $this->post_ids[] = $child['post'];
                    }
                }
            }
        }
        return $this->post_ids;
    }

    /**
     * Tells whether or not this list contains one or more articles connected
     * to the post with given id
     * @param int $post_id
     * @return bool
     */
    public function containsPost($post_id)
    {
        return in_array($post_id, $this->getContainingPosts());
    }

    /**
     * @param array $articles
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;
        $this->post_ids = false;
    }

    /**
     * @return array
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param int $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return int
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param int $maxlength
     */
    public function setMaxlength($maxlength)
    {
        $this->maxlength = $maxlength;
    }

    /**
     * @return int
     */
    public function getMaxlength()
    {
        return $this->maxlength;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        foreach($options as $name => $val) {
            if( is_numeric($val) )
                $options[$name] = (int)$val;
        }
        $this->options = $options;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        $this->options['hidden_templates'] = apply_filters('arlima_hidden_templates', array(), $this);
        return $this->options;
    }

    /**
     * Will return the HTMl element used as header for articles in this list.
     * If something other then a valid header element is used this function
     * will return an empty string
     * @return string
     */
    function getTitleElement()
    {
        $title_parts = explode('>', $this->options['before_title']); // todo: use regexp instead
        $element = trim(str_replace('<', '', $title_parts[0]));
        $space_pos = strpos($element, ' ');
        if ( $space_pos !== false ) {
            $element = substr($element, 0, $space_pos);
        }

        if ( in_array($element, array('h1', 'h2', 'h3', 'h4', 'h5', 'p', 'div', 'header')) ) {
            return $element;
        } else {
            return '';
        }
    }

    /**
     * @return int
     */
    function numArticles()
    {
        return count($this->articles);
    }

    /**
     * Get the modification date (timestamp) when this version of the list
     * was created
     * @return int
     */
    function lastModified()
    {
        return !empty($this->version['created']) ? $this->version['created'] : $this->created;
    }

    /**
     * Returns info about the version of this list
     * @param string $no_version_text[optional=''] The text returned if this is list is of no version
     * @return string
     */
    function getVersionInfo($no_version_text = '')
    {
        if( $this->isImported() ) {
            return sprintf(__('Last modified %s a go', 'arlima'), human_time_diff($this->version['created']));
        } else {
            $version = $this->version;
            if ( isset($version['id']) && isset($version['user_id']) ) {
                Arlima_Plugin::loadTextDomain();
                $user_data = get_userdata($version['user_id']);
                $saved_since = '';
                $saved_by = 'Unknown';
                $lang_saved_since = __(' saved since ', 'arlima');
                $lang_by = __(' by ', 'arlima');

                if ( !empty($version['created']) ) {
                    $saved_since = $lang_saved_since . human_time_diff($version['created']);
                }
                if ( $user_data ) {
                    $saved_by = $user_data->display_name;
                }

                return 'v ' . $version['id'] . ' ' . $saved_since . $lang_by . $saved_by . ($this->is_imported ? ' (IMPORT)' : '');
            } else {
                return $no_version_text . ($this->is_imported ? ' (IMPORT)' : '');
            }
        }
    }

    /**
     * @return bool
     */
    function isLatestPublishedVersion()
    {
        return !$this->isPreview() &&
            isset($this->version['id']) &&
            (empty($this->versions) || $this->versions[0] == $this->version['id']);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $arr = array();
        foreach($this as $key => $val) {
            if( $key !== 'preview' )
                $arr[$key] = $val;
        }

        return $arr;
    }



    /* * * * * * * * * * * * * * * * STATIC UTILITY FUNCTIONS * * * * * * * * */


    /**
     * @param array $article
     * @param array $options
     * @param array $header_classes
     * @return string
     */
    public static function getTitleHtml($article, $options, $header_classes=array())
    {

        if ( $article['title'] == '' ) {
            return '';
        }

        $underscore_replace = !isset($options['convertBreaks']) || $options['convertBreaks'] ? '<br />':'';
        $title = str_replace('__', $underscore_replace, $article['title']);

        if ( !empty($article['options']['preTitle']) ) {
            $title = '<span class="arlima-pre-title">' . $article['options']['preTitle'] . '</span> ' . $title;
        }

        $title_html = '';
        $header_classes[] = 'fsize-' . $article['size'];

        $start_tag = empty($options['before_title']) ? '<h2>' : $options['before_title'];
        $end_tag = empty($options['after_title']) ? '</h2>' : $options['after_title'];

        if ( !empty($header_classes) ) {
            if ( stristr($start_tag, 'class') !== false ) {
                $start_tag = str_replace(
                    'class="',
                    'class="' . implode(' ', $header_classes) . ' ',
                    $start_tag
                );
            } else {
                $start_tag = str_replace(
                    '>',
                    ' class="' . implode(' ', $header_classes) . '">',
                    $start_tag
                );
            }
        }

        if ( !empty($article['url']) ) {
            $title_html .= self::linkWrap($article, $title);
        } else {
            $title_html .= $title;
        }

        return $start_tag . $title_html . $end_tag;
    }



    /**
     * Use the overriding url if it exists, otherwise the permalink of the post that
     * the article is connected to
     * @param $article
     * @return null|string
     */
    public static function resolveURL($article)
    {
        if( !empty($article['options']) && !empty($article['options']['overridingURL']) ) {
            return $article['options']['overridingURL'];
        } elseif( !empty($article['post']) ) {
            return get_permalink($article['post']);
        }
        return '';
    }


    /**
     * Wrap given content with article link
     * @param array $article
     * @param string $content
     * @return string
     */
    public static function linkWrap($article, $content, $classes = array())
    {
        if( !empty($article['url']) ) {
            $opts = $article['options'];
            return sprintf(
                '<a href="%s"%s%s>%s</a>',
                $article['url'],
                empty($opts['target']) ? '':' target="'.$opts['target'].'"',
                empty($classes) ? '' : ' class="'.implode(' ', $classes).'"',
                $content
            );
        }
        return $content;
    }


    /**
     * @return array
     */
    public static function getDefaultListOptions()
    {
        $self = new self();
        return $self->options;
    }
}