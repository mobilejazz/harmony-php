<?php

namespace Harmony\Core\Module\Doctrine\MongoDB;

use Carbon\CarbonImmutable;
use DateTimeImmutable;
use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\Annotations\HasLifecycleCallbacks;
use Doctrine\ODM\MongoDB\Mapping\Annotations\PrePersist;

/**
 * @HasLifecycleCallbacks
 */
trait TraitCreatedAt {
  #[MongoDB\Field(type: "date_immutable")]
  private ?DateTimeImmutable $created_at;

  public function getCreatedAt(): ?DateTimeImmutable {
    return $this->created_at;
  }

  #[PrePersist]
  public function prePersistCreatedAt(LifecycleEventArgs $eventArgs): void {
    $this->created_at = new CarbonImmutable();
  }
}
