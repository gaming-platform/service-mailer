<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Port\Adapter\Persistence\Template;

use GamingPlatform\Mailer\Domain\Participant;
use GamingPlatform\Mailer\Domain\Template\Template;
use GamingPlatform\Mailer\Domain\Template\Templates;

final class DummyTemplates implements Templates
{
    /**
     * @inheritdoc
     */
    public function byName(string $name): Template
    {
        return new Template(
            $name,
            new Participant('john@doe.de', 'John Doe'),
            'Hello {{ name }}',
            <<<TEMPLATE
<p>
Hello {{ name }} {{ surname }},
</p>
<p>
This is a dummy template.
</p>
TEMPLATE,
            <<<TEMPLATE
Hello {{ name }} {{ surname }},

This is a dummy template.
TEMPLATE
        );
    }
}
