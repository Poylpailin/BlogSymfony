<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query\Expr as Expr;

/**
 * TagRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TagRepository extends EntityRepository
{
    public function findCatchAll($id = null)
    {
        $qb = $this->createQueryBuilder('t');
        $qb
            ->select('t, a')
            ->leftJoin('t.articles', 'a', Expr\Join::WITH)
            ->orderBy('t.id', 'DESC');
        ;
        if (null !== $id) {
            $qb
                ->where('t.id = :id')
                ->setParameters([
                    ':id' => $id,
                ])
            ;
        }
        return null === $id
            ? $qb->getQuery()->getArrayResult()
            : $qb->getQuery()->getSingleResult(AbstractQuery::HYDRATE_ARRAY);
    }
}
