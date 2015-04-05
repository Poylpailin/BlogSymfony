<?php
namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query\Expr as Expr;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{
    public function findCatchAll($id = null)
    {
        $qb = $this->createQueryBuilder('a');
        $qb
            ->select('a, u, c, t')
            ->leftJoin('a.user', 'u', Expr\Join::WITH)
            ->leftJoin('a.categories', 'c', Expr\Join::WITH)
            ->leftJoin('a.tags', 't', Expr\Join::WITH)
            ->orderBy('a.id', 'DESC');
        ;
        if (null !== $id) {
            $qb
                ->where('a.id = :id')
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