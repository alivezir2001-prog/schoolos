# ADR-015

## Title

Separate Understanding and Development Engines

---

## Status

Accepted

---

## Date

2026-07-13

---

## Context

Educational understanding and educational intervention represent fundamentally different processes.

Attempting to combine them would reduce explainability and increase the risk of premature recommendations.

---

## Decision

SchoolOS is designed around two complementary intelligence engines.

The Understanding Engine builds trustworthy educational understanding.

The Development Engine supports educational development based upon that understanding.

Both engines remain intentionally separated.

---

## Rationale

Responsible educational action requires trustworthy understanding.

Understanding should mature before intervention is considered.

---

## Consequences

Development Engine will be implemented after the Understanding Engine reaches sufficient maturity.

The architecture remains modular and explainable.

---

## Alternatives Considered

### Single educational intelligence engine.

Rejected because understanding and intervention require different responsibilities.

---

## Related Documents

- EDUCATIONAL_KNOWLEDGE_MODEL.md

---

## Notes

Understand first.

Support development second.