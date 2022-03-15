<?php

namespace Thetomnewton\LaravelDocFixer;

use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;

class LaravelDocblocks implements FixerInterface
{
    public function isCandidate(Tokens $tokens): bool
    {
        return true;
    }

    public function fix(\SplFileInfo $file, Tokens $tokens): void
    {
        foreach ($tokens as $index => $token) {
            $content = trim($token->getContent());
            if (! $token->isComment() || $content === '//') {
                continue;
            }

            $out = preg_replace([
                '/(\\*@)/',
                '/(@return  )/',
                '/(@var  )/',
                '/(@param )([^ ])/',
                '/(@param)( {3,})/',
                '/(@param  )([^ ]*)(?<=[^( \n)])( )([^ ]*)/',
                '/(@param  )([^( \n)]*)( {3,})/',
            ], [
                '* @',
                '@return ',
                '@var ',
                '$1 $2',
                '$1  ',
                '$1$2  $4',
                '$1$2  ',
            ], $content);

            $tokens[$index] = new Token([T_DOC_COMMENT, $out]);
        }
    }

    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition(
            '@param comments should have 2 spaces, @return and @var should have 1.',
            [
                new CodeSample(
                    '<?php
    /**
     * A property.
     *
     * @var string
     */
    public $someVar;

    /**
     * A method.
     *
     * @param  string  $foo
     * @return void
     */
    public someMethod($foo) {};'
                ),
            ]
        );
    }

    public function getName(): string
    {
        return 'LaravelDocblocks/laravel_style_docs';
    }

    public function getPriority(): int
    {
        return 0;
    }

    public function supports(\SplFileInfo $file): bool
    {
        return true;
    }

    public function isRisky(): bool
    {
        return true;
    }
}
