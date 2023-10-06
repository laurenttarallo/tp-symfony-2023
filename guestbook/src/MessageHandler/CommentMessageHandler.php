<?php

namespace App\MessageHandler;

use App\Enum\CommentStateEnum;
use App\Message\CommentMessage;
use App\Repository\CommentRepository;
use App\SpamChecker;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CommentMessageHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SpamChecker $spamChecker,
        private CommentRepository $commentRepository,
    ) {
    }
    public function __invoke(CommentMessage $message)
    {
        $comment = $this->commentRepository->find($message->getId());
        if (null === $comment) {
            return;
        }
        $comment->setState(CommentStateEnum::PUBLISHED);
        if (2 === $this->spamChecker->getSpamScore($comment, $message->getContext())) {
            $comment->setState(CommentStateEnum::SPAM);
        }
        $this->entityManager->flush();
    }
}
