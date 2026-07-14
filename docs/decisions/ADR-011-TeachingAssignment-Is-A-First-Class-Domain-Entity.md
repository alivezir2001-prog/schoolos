# ADR-011

## Title

TeachingAssignment Is A First-Class Domain Entity

---

## Status

Accepted

---

## Date

2026-07-13

---

## Context

The original relationship between Teacher and Lesson was modeled as a simple many-to-many association.

As the academic model evolved, it became clear that teaching responsibilities require additional educational context such as academic year, class, workload and scheduling.

A simple relationship could no longer represent this complexity.

---

## Decision

TeachingAssignment is defined as a first-class domain entity.

Teaching responsibilities are represented explicitly rather than as a direct Teacher–Lesson relationship.

---

## Rationale

Teaching is an educational responsibility rather than merely a relationship between two entities.

Modeling TeachingAssignment explicitly improves flexibility, traceability and future extensibility.

---

## Consequences

Future academic modules will reference TeachingAssignment instead of direct Teacher–Lesson relations.

The academic domain becomes more expressive and easier to extend.

---

## Alternatives Considered

### Teacher–Lesson many-to-many relationship.

Rejected because it cannot adequately represent educational context.

---

## Related Documents

- DOMAIN_MODEL.md
- EDUCATIONAL_CONTEXT_MODEL.md

---

## Notes

TeachingAssignment represents educational responsibility rather than simple association.