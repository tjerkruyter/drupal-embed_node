<?php


/**
 * @file
 * Contains \Drupal\embed_node\Twig\EmbedViewExtension.
 */

namespace Drupal\embed_node\Twig;


/**
 * Class EmbedViewExtension
 * Print a menu
 * @package Drupal\embed_view\Twig
 */
class EmbedNodeExtension extends \Twig_Extension {
    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'embed_node';
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions() {
        return [
            new \Twig_SimpleFunction('embed_node', [$this, 'embedNode'], [
                'is_safe' => ['html'],
            ]),
            new \Twig_SimpleFunction('embed_node_object', [$this, 'embedNodeObject'], [
                'is_safe' => ['html'],
            ]),
            new \Twig_SimpleFunction('embed_node_field', [$this, 'embedNodeField'], [
                'is_safe' => ['html'],
            ]),            
        ];
    }

    public function embedNode($nid, $viewMode = 'teaser') {
        $node = \Drupal\node\Entity\Node::load($nid);
        $viewBuilder = \Drupal::entityManager()->getViewBuilder('node');

        return $viewBuilder->view($node, $viewMode);
    }

    public function embedNodeObject(Node $node, $viewMode = 'teaser') {
        $viewBuilder = \Drupal::entityManager()->getViewBuilder('node');

        return $viewBuilder->view($node, $viewMode);
    }

    public function embedNodeField($field, $displayOptions = []) {
        return $field->view($displayOptions);
    }
}
