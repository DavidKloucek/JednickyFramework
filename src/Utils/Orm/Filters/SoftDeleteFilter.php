<?php
declare(strict_types=1);

namespace Jednicky\Orm\Filters;

use Doctrine\ORM\Mapping\ClassMetaData;
use Doctrine\ORM\Query\Filter\SQLFilter;

class SoftDeleteFilter extends SQLFilter
{
    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias): string
    {
        if ($targetEntity->hasField("isDeleted")) {
            return $targetTableAlias.".is_deleted=0";
        } else if ($targetEntity->hasField("isDelete")) {
            return $targetTableAlias.".is_delete=0";
        }
        return '';
    }
}
