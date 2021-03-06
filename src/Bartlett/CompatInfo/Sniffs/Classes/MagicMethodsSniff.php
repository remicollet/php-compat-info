<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\Classes;

use Bartlett\CompatInfo\Sniffs\SniffAbstract;

use PhpParser\Node;

/**
 * Report use of magic methods
 *
 * @link https://www.php.net/manual/en/language.oop5.magic.php
 *
 * @see tests/Sniffs/MagicMethodsSniffTest
 * @since Class available since Release 5.4.0
 */
final class MagicMethodsSniff extends SniffAbstract
{
    private $mm501;
    private $mm503;
    private $mm506;

    /**
     * {@inheritDoc}
     */
    public function enterSniff(): void
    {
        parent::enterSniff();

        $this->mm501 = ['__isset', '__unset', '__set_state'];
        $this->mm503 = ['__callStatic', '__invoke'];
        $this->mm506 = ['__debugInfo'];
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        parent::enterNode($node);

        if (!$node instanceof Node\Stmt\ClassMethod) {
            return null;
        }

        $name = (string) $node->name;

        if (in_array($name, $this->mm501)) {
            $min = '5.1.0';
        } elseif (in_array($name, $this->mm503)) {
            $min = '5.3.0';
        } elseif (in_array($name, $this->mm506)) {
            $min = '5.6.0';
        } else {
            return null;
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => $min]);
    }
}
