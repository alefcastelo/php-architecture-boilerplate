<?php

declare(strict_types=1);

namespace Descarga\Subscriber\Repository;

use Descarga\Shared\Exception\DomainLogicException;
use Descarga\Subscriber\Entity\Subscriber;
use Descarga\Subscriber\Input\SubscriberListFiltersInput;
use Descarga\Subscriber\SubscriberRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Throwable;

class SubscriberPostgresRepository extends ServiceEntityRepository implements SubscriberRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subscriber::class);
    }

    public function findOneById(int $id): Subscriber
    {
        return $this->findOneBy([
            'id' => $id,
        ]);
    }

    public function getById(int $id): Subscriber
    {
        $subscriber = $this->findOneById($id);

        if (!$subscriber) {
            throw new DomainLogicException('Subscriber not found.');
        }

        return $subscriber;
    }

    public function create(Subscriber $subscriber): void
    {
        try {
            $this->getEntityManager()->persist($subscriber);
            $this->getEntityManager()->flush();
        } catch (Throwable $exception) {
            throw new DomainLogicException('Subscriber could not be created.', 0, $exception);
        }
    }

    public function update(Subscriber $subscriber): void
    {
        try {
            $this->getEntityManager()->persist($subscriber);
            $this->getEntityManager()->flush();
        } catch (Throwable $exception) {
            throw new DomainLogicException('Subscriber could not be updated.', 0, $exception);
        }
    }

    public function list(SubscriberListFiltersInput $filters): array
    {
        return $this->createQueryBuilder('s')
            ->setFirstResult(--$filters->page * $filters->limit)
            ->setMaxResults($filters->limit)
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
